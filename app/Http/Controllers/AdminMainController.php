<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\SettingsModel;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;
use Intervention\Image\ImageManagerStatic as Image;
use ImageResize;


class AdminMainController extends Controller
{
    public function index()
    {
        if (!Auth::user())
            return redirect('/login');

        $posts = app(MainController::class)->helper('postsCount');
        $allComments = app(MainController::class)->helper('getComments');
        $allSubscribe = app(MainController::class)->helper('getAllSubscribe');
        $allContacts = app(MainController::class)->helper('getAllContacts');

        $postsCount = $posts->count();
        $allCommentsCount = $allComments->count();
        $allSubscribeCount = $allSubscribe->count();
        $allContactsCount = $allContacts->count();

        return view('admin.home', compact('postsCount', 'allCommentsCount', 'allSubscribeCount', 'allContactsCount', 'allContactsCount'));
    }

    public function getSettings()
    {
        try {
            if(!Auth::user())
                return redirect('/login');

            $settings = SettingsModel::all()->pluck('value', 'key_')->toArray();
            return view('admin.settings', compact('settings'));

        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }

    }

    public function saveSettings(Request $request)
    {
        try {
            foreach ($request->except('_token') as $key => $value) {
                SettingsModel::where('key_', '=', $key)->update(['value' => $value]);
            }

            return redirect()->back()->with(['Status' => 'success', 'Title' => 'Başarılı!!', 'Message' => 'Başarıyla Güncellendi']);

        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }


    }

    public function getPosts()
    {
        try {
            if (!Auth::user())
                return redirect('/login');

            $posts = app(MainController::class)->helper('adminPosts');
            return view('admin.posts', compact('posts'));

        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function removePost($id)
    {
        try {
            $post = PostModel::find($id);
            $path = public_path() . "/assets/uploads/" . $post->img;
            unlink($path);
            $post->delete();

            if (!$post)
                return redirect()->route('adminPosts')->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => 'Silerken bir hata ile karşılaşıldı!']);

            return redirect()->route('adminPosts')->with(['Status' => 'success', 'Title' => 'Başarılı!', 'Message' => 'KAyıt başarıyla silindi!']);


        } catch (\Throwable $th) {
            return redirect()->route('adminPosts')->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }


    }

    public function editPost($id)
    {
        try {
            $post = PostModel::find($id);
            $mainCats = app(MainController::class)->helper('mainCats');

            /* posttaki alt kategorinin ala kategorsini getirir */
            $postMainCat = app(MainController::class)->helper('getCatWithId', app(MainController::class)->helper('getCatWithId', $post->category_id)->parent_id);


            return view('admin.add_post', compact(['post', 'mainCats', 'postMainCat']));

        } catch (\Throwable $th) {
            return redirect()->route('adminPosts')->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getAddPost()
    {
        try {
            $mainCats = app(MainController::class)->helper('mainCats');
            return view('admin.add_post', compact('mainCats'));

        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getSubCatWithAjax(Request $request)
    {
        $subCat = app(MainController::class)->helper('subCatWithId', $request->id);
        return response()->json([
            'data' => $subCat,
        ]);
    }

    public function savePost(Request $request)
    {
        try {

            $this->validate($request, [
                'img' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            ]);


            if ($request->postid <> null) {
                $post = PostModel::find($request->postid);
            } else
                $post = new PostModel;

            if ($request->hasFile('img')) {

                $file = $request->file('img');
                $extn = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extn;
                $file->move('assets/uploads/', $fileName);


                if ($post->img <> null) {
                    $path = public_path() . "/assets/uploads/" . $post->img;
                    //$pathList = public_path() . "/assets/uploads/list-" . $post->img;
                    unlink($path);
                    //unlink($pathList);
                }

                if (!$file)
                    return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => 'Resim yüklenirken bir hata oluştu.']);
            } else
                $fileName = $request->oldImg;

            $post->title = $request->title;
            $post->description = $request->description;
            $post->img = $fileName;
            $post->listimg = 'list-' . $fileName;
            $post->category_id = $request->subcategory;
            $post->tags = $request->tags;
            $post->save();

            if ($post)
                return redirect()->route('adminPosts')->with(['Status' => 'success', 'Title' => 'Başarılı.', 'Message' => 'Başarıyla Kaydedildi.']);

            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => 'Kaydedilirken Bir Hata Alındı.']);

        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getCategories()
    {
        $mainCats = app(MainController::class)->helper('mainCats');
        return view('admin.categories', compact('mainCats'));
    }

    public function actionCats(Request $request)
    {
        try {
            if ($request->action == 'save') {
                if (!empty($request->newCategory)) {
                    $cats = CategoryModel::create(['category' => $request->newCategory, 'parent_id' => 0]);
                    if (!$cats)
                        return redirect()->route('adminCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Yeni Kategori Eklenirken bir hata oluştu']);
                } else {
                    return redirect()->route('adminCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Yeni kategori eklerken o alanı boş bırakamzsın.']);
                }

                return redirect()->route('adminCats')->with(['Status' => 'success', 'Title' => 'Kayıt Başarılı.', 'Message' => 'Kategori Başarıyla kaydedilmiştir.']);

            } elseif ($request->action == 'delete') {
                if (!empty($request->deleteCategory)) {
                    foreach ($request->deleteCategory as $id) {
                        $cats = CategoryModel::find($id);
                        $cats->delete();

                        $subCats = app(MainController::class)->helper('subCatWithId', $id);

                        foreach ($subCats as $subCat) {
                            $subCat->delete();
                        }

                        if (!$cats || !$subCats)
                            return redirect()->route('adminCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Yeni Kategori Eklenirken bir hata oluştu']);
                    }

                } else {
                    return redirect()->route('adminCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Kategori silmek için bir seçim yapmalısın.']);
                }

                return redirect()->route('adminCats')->with(['Status' => 'success', 'Title' => 'Silme Başarılı.', 'Message' => 'Alt kategorileri varsa onlar da silinmişir.']);
            }


        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getSubCategories()
    {
        $mainCats = app(MainController::class)->helper('mainCats');
        return view('admin.subcategories', compact('mainCats'));
    }

    public function actionSubCats(Request $request)
    {
        try {
            if ($request->action == 'save') {
                if (!empty($request->newSubCategory)) {
                    if ($request->mainCats != 0) {
                        $subcats = CategoryModel::create(['category' => $request->newSubCategory, 'parent_id' => $request->mainCats]);
                        if (!$subcats)
                            return redirect()->route('adminSubCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Yeni Kategori Eklenirken bir hata oluştu']);
                    } else {
                        return redirect()->route('adminSubCats')->with(['Status' => 'warning', 'Title' => 'Dikkat!', 'Message' => 'Alt Kategori Eklemeniz için bir ana kategori seçmelisiniz!.']);
                    }
                } else {
                    return redirect()->route('adminSubCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Yeni kategori eklerken o alanı boş bırakamzsın.']);
                }

                return redirect()->route('adminSubCats')->with(['Status' => 'success', 'Title' => 'Kayıt Başarılı.', 'Message' => 'Alt Kategori Başarıyla kaydedilmiştir.']);

            } elseif ($request->action == 'delete') {
                if (!empty($request->deletesubcats)) {
                    foreach ($request->deletesubcats as $id) {
                        $cats = CategoryModel::find($id);
                        $cats->delete();

                        if (!$cats)
                            return redirect()->route('adminSubCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Yeni Kategori Eklenirken bir hata oluştu']);
                    }
                } else {
                    return redirect()->route('adminSubCats')->with(['Status' => 'error', 'Title' => 'Hata', 'Message' => 'Kategori silmek için bir seçim yapmalısın.']);
                }

                return redirect()->route('adminSubCats')->with(['Status' => 'success', 'Title' => 'Silme Başarılı.', 'Message' => 'Alt kategori silinmişir.']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getComments()
    {

        $allComments = app(MainController::class)->helper('getCommentsPaginate');
        return view('admin.comments', compact('allComments'));
    }

    public function deleteComment($id)
    {
        try {

            $comment = app(MainController::class)->helper('getAComment', $id);
            $comment->delete();

            if (!$comment)
                return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => 'Silinirken bir hata oluştu.']);

            return redirect()->route('adminComments')->with(['Status' => 'success', 'Title' => 'Başarılı!!', 'Message' => 'Silme işlemi başarılı']);


        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getSubscribes()
    {

        $allSubscribes = app(MainController::class)->helper('getSubscribesPaginate');
        return view('admin.subscribes', compact('allSubscribes'));
    }

    public function deleteSubscribe($id)
    {
        try {

            $subscribe = app(MainController::class)->helper('getASubscribe', $id);
            $subscribe->delete();

            if (!$subscribe)
                return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => 'Silinirken bir hata oluştu.']);

            return redirect()->route('adminSubscribes')->with(['Status' => 'success', 'Title' => 'Başarılı!!', 'Message' => 'Silme işlemi başarılı']);


        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

    public function getContacts()
    {

        $allContacts = app(MainController::class)->helper('getContactsPaginate');
        return view('admin.contacts', compact('allContacts'));
    }

    public function deleteContact($id)
    {
        try {

            $contact = app(MainController::class)->helper('getAContact', $id);
            $contact->delete();

            if (!$contact)
                return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => 'Silinirken bir hata oluştu.']);

            return redirect()->route('adminContacts')->with(['Status' => 'success', 'Title' => 'Başarılı!!', 'Message' => 'Silme işlemi başarılı']);


        } catch (\Throwable $th) {
            return redirect()->back()->with(['Status' => 'error', 'Title' => 'Hata!!', 'Message' => $th->getMessage()]);
        }
    }

}
