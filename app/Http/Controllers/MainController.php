<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\ContactModel;
use App\Models\PatternsModel;
use App\Models\PostModel;
use App\Models\SettingsModel;
use App\Models\SubscribeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        try {
            $settings = $this->helper('settings');
            $posts = $this->helper('posts');
            $lastestPosts = $this->helper('lastest');
            $postsDateDistinct = $this->helper('postDateDistinct');
            $tags = $this->helper('tags');
            $catParent0 = $this->helper('mainCats');


            return view('main', ['settings' => $settings, 'posts' => $posts, 'postsDateDistinct' => $postsDateDistinct, 'tags' => $tags, 'lastestPosts' => $lastestPosts, 'catParent0' => $catParent0]);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage()]);
        }
    }

    public function searchCategory($categoryId)
    {
        try {
            $settings = $this->helper('settings');
            $postsDateDistinct = $this->helper('postDateDistinct');
            $tags = $this->helper('tags');
            $lastestPosts = $this->helper('lastest');
            $catParent0 = $this->helper('mainCats');

            $catControl = CategoryModel::find($categoryId)->parent_id;

            if ($catControl == 0) // Ana kategori ise drek id ile join edip ana kategorideki postları getirecek
                $posts = PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->where('category.parent_id', '=', $categoryId)->orderBy('post.created_at', 'desc')->paginate(15); // o kategoriid deki postları getir
            else // ana kategori değilse alt kategorideki postları getirecek
                $posts = PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->where('category.id', '=', $categoryId)->orderBy('post.created_at', 'desc')->paginate(15); // o kategoriid deki postları getir

            if (count($posts))
                $searchText = CategoryModel::where('id', '=', $categoryId)->first()->category;
            else
                $searchText = 'Sonuc Bulunamadı';


            return view('search')->with('settings', $settings)->with('postsDateDistinct', $postsDateDistinct)->with('tags', $tags)->with('posts', $posts)->with('searchText', $searchText)->with('lastestPosts', $lastestPosts)->with('catParent0', $catParent0);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage(),
            ]);
        }
    }

    public function searchTag($tag)
    {
        try {
            $settings = $this->helper('settings');
            $postsDateDistinct = $this->helper('postDateDistinct');
            $tags = $this->helper('tags');
            $lastestPosts = $this->helper('lastest');
            $catParent0 = $this->helper('mainCats');


            $posts = PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->where(strtoupper('tags'), 'LIKE', '%' . strtoupper(trim($tag)) . '%')->orderBy('post.created_at', 'desc')->paginate(15); // o tag teki postları getir.
            $searchText = $tag;

            return view('search')->with('settings', $settings)->with('postsDateDistinct', $postsDateDistinct)->with('tags', $tags)->with('posts', $posts)->with('searchText', $searchText)->with('lastestPosts', $lastestPosts)->with('catParent0', $catParent0);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage(),
            ]);
        }
    }

    public function searchDate($date_)
    {
        try {
            $settings = $this->helper('settings');
            $postsDateDistinct = $this->helper('postDateDistinct');
            $tags = $this->helper('tags');
            $lastestPosts = $this->helper('lastest');
            $catParent0 = $this->helper('mainCats');


            $year = substr($date_, -4);
            $month = substr($date_, 0, strlen($date_) - 5);
            $datePars = Carbon::parseFromLocale($year . "-" . $month . "-01");
            $start = $datePars->startOfMonth()->format('Y-m-d');
            $end = $datePars->endOfMonth()->format('Y-m-d');

            $posts = PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->whereBetween('post.created_at', [$start, $end])->orderBy('post.created_at', 'desc')->paginate(15); // o tag teki postları getir.
            $searchText = $date_;

            return view('search')->with('settings', $settings)->with('postsDateDistinct', $postsDateDistinct)->with('tags', $tags)->with('posts', $posts)->with('searchText', $searchText)->with('lastestPosts', $lastestPosts)->with('catParent0', $catParent0);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage(),
            ]);
        }
    }

    public function postDetail($postId)
    {
        try {
            $settings = $this->helper('settings');
            $postsDateDistinct = $this->helper('postDateDistinct');
            $lastestPosts = $this->helper('lastest');
            $tags = $this->helper('tags');
            $post = $this->helper('getPostDetail', $postId);
            $catParent0 = $this->helper('mainCats');

            $relatedPosts = $this->getMainCat($post->category_id);


            $comments = $this->helper('getMainComments', $postId);
            $commentsCount = $this->helper('getCommentsCount', $postId);


            return view('post_detail')->with('settings', $settings)->with('postsDateDistinct', $postsDateDistinct)->with('tags', $tags)->with('post', $post)->with('lastestPosts', $lastestPosts)->with('catParent0', $catParent0)->with('relatedPosts', $relatedPosts)->with('comments', $comments)->with('commentsCount', $commentsCount);

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage()]);
        }
    }

    public function postComment(Request $request)
    {
        try {

            $comment = CommentModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'avatar' => 'https://eu.ui-avatars.com/api/?name=' . trim($request->name),
                'parent_comment_id' => $request->parent_id,
                'postid' => $request->postid,
            ]);

            if (!$comment)
                return redirect()->back()->with('Title', 'Hata!')->with('Message', 'Yorum yapılırken bir hata oluştu.')->with('Status', 'error');


            return redirect()->back()->with('Title', 'Başarılı!')->with('Message', 'Yorum başarıyla yapıldı.')->with('Status', 'success');

        } catch (\Throwable $th) {
            return redirect()->back()->with('Title', 'Hata!')->with('Message', $th->getMessage())->with('Status', 'error');
        }
    }

    public function searchKeyword(Request $request)
    {
        try {
            $settings = $this->helper('settings');
            $lastestPosts = $this->helper('lastest');
            $postsDateDistinct = $this->helper('postDateDistinct');
            $tags = $this->helper('tags');
            $catParent0 = $this->helper('mainCats');


            $posts = PostModel::select(DB::raw('post.*, category.category'))
                ->join('category', 'category.id', 'post.category_id')
                ->orWhere(strtoupper('tags'), 'LIKE', '%' . strtoupper(trim($request->keyword)) . '%')
                ->orWhere(strtoupper('title'), 'LIKE', '%' . strtoupper(trim($request->keyword)) . '%')
                ->orWhere(strtoupper('description'), 'LIKE', '%' . strtoupper(trim($request->keyword)) . '%')
                ->orWhere(strtoupper('category'), 'LIKE', '%' . strtoupper(trim($request->keyword)) . '%')
                ->orderBy('post.created_at', 'desc')
                ->paginate(15);

            if ($posts->count() > 0)
                return view('search', ['settings' => $settings, 'posts' => $posts, 'postsDateDistinct' => $postsDateDistinct, 'tags' => $tags, 'lastestPosts' => $lastestPosts, 'searchText' => $request->keyword, 'catParent0' => $catParent0]);
            else {
                $posts = $this->helper('posts');
                return view('search', ['settings' => $settings, 'posts' => $posts, 'postsDateDistinct' => $postsDateDistinct, 'tags' => $tags, 'lastestPosts' => $lastestPosts, 'searchText' => "'" . $request->keyword . "'" . "  Kayıt Bulunamadı", 'catParent0' => $catParent0]);
            }

            return redirect()->back();

        } catch (\Throwable $th) {
            return response()->json([
                'Status' => false,
                'Message' => $th->getMessage()]);
        }
    }

    public function subscribe(Request $request)
    {
        try {

            if (SubscribeModel::where('email', '=', trim($request->email))->exists())
                return redirect()->back()->with('Title', 'Hata!')->with('Message', 'Mail adresi zaten abonedir.')->with('Status', 'error');

            $subscribe = SubscribeModel::create(['email' => $request->email,]);
            $subscribe->save();

            if ($subscribe)
                return redirect()->back()->with('Title', 'Başarılı!')->with('Message', 'Başarıyla Abone Olundu')->with('Status', 'success');

            return redirect()->back()->with('Title', 'Hata!')->with('Message', 'Abone işlemi başarısız')->with('Status', 'error');

        } catch (\Throwable $th) {
            return redirect()->back()->with('Title', $th->getCode())->with('Message', $th->getMessage())->with('Status', 'error');
        }
    }

    public function helper($text, $id = null)
    {
        if ($text == 'settings')
            return SettingsModel::all()->pluck('value', 'key_')->toArray();

        if ($text == 'categories')
            return CategoryModel::orderBy('parent_id')->get();

        if ($text == 'mainCats')
            return CategoryModel::where('parent_id', '=', 0)->get();

        if ($text == 'getCatWithId')
            return CategoryModel::where('id', '=', $id)->first();

        if ($text == 'subCatWithId')
            return CategoryModel::where('parent_id', '=', $id)->get();

        if ($text == 'subCatWithIdOnlyIDs')
            return PostModel::join('category', 'category.id', 'post.category_id')->where('category.parent_id', '=', $id)->select('post.*')->get();

        if ($text == 'posts')
            return PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->orderBy('created_at', 'desc')->paginate(15);

        if ($text == 'adminPosts')
            return PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->orderBy('created_at', 'desc')->paginate(5);

        if ($text == 'postsCount')
            return PostModel::all();

        if ($text == 'postDateDistinct') {
            $finalDisDate = array(); // post olmadığında hata vermesin bu değişken yok diye
            $postsDateDistinct = DB::table('post')
                ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->distinct()
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

            // Tarihi set locale göre yazdırmak için burayı yaptık
            foreach ($postsDateDistinct as $item)
                // önce str yi tarih formatına çevirmemiz lazım parse ederken hata alır.
                // translated format da ServisProvider da Carbon set locel yaptıgımız dile uyguluyor formatı
                $finalDisDate[] = Carbon::createFromFormat('m-Y', $item->month . '-' . $item->year)->translatedFormat('F Y');

            return $finalDisDate;
        }

        if ($text == 'tags') {
            $allPosts = PostModel::join('category', 'category.id', 'post.category_id')->get();
            $tags = array();
            foreach ($allPosts as $item)
                foreach (explode(',', $item->tags) as $itm)
                    array_push($tags, trim($itm)); // tüm taglerı bir dizie eleman olarak ekliyoruz.


            return implode(',', array_unique($tags)); // her elemnı tek bir eleman haline getirip virgüllerle ayırıyorıuz
        }

        if ($text == 'lastest')
            return PostModel::orderBy('created_at', 'desc')->take(3)->get();

        if ($text == 'subCats')
            return CategoryModel::where('parent_id', '!=', '0')->pluck('parent_id')->toArray();//where('parent_id', '!=', 0)->get();

        if ($text == 'getPostDetail')
            return PostModel::select(DB::raw('post.*, category.category'))->join('category', 'category.id', 'post.category_id')->where('post.id', '=', $id)->first();


        if ($text == 'getComments')
            return CommentModel::all();

        if ($text == 'getAComment')
            return CommentModel::find($id);

        if ($text == 'getCommentsPaginate')
            return CommentModel::paginate(15);

        if ($text == 'getMainComments')
            return CommentModel::where('parent_comment_id', '=', 0)->where('postid', $id)->get();

        if ($text == 'getCommentsCount')
            return CommentModel::where('postid', $id)->count();

        if ($text == 'getAllSubscribe')
            return SubscribeModel::all();

        if ($text == 'getAllContacts')
            return ContactModel::all();

        if ($text == 'getSubscribesPaginate')
            return SubscribeModel::paginate(15);

        if ($text == 'getASubscribe')
            return SubscribeModel::find($id);

        if ($text == 'getContactsPaginate')
            return ContactModel::paginate(15);

        if ($text == 'getAContact')
            return ContactModel::find($id);

        if($text == 'getAllPatterns')
            return PatternsModel::all();

        if($text == 'getPatternWithId')
        {
            return PatternsModel::find($id);
        }


    }

    public function getMainCat($id)
    {

        $isMainCat = $this->helper('getCatWithId', $id);
        if ($isMainCat->parent_id == 0)
            return $this->helper('subCatWithIdOnlyIDs', $isMainCat->id);
        else
            return $this->getMainCat($isMainCat->parent_id);
    }

}
