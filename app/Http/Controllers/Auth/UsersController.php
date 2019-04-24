<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\BaseController;
use App\User as PageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use View;
use File;

class UsersController extends BaseController{
    public function __construct(PageModel $model)
    {
        $this->middleware('auth');
        $this->pageUrl='users';
        $this->pageName = 'Kullanıcılar';
        $this->pageItem = 'Kullanıcı';
        $this->model = $model;
        $this->fields = $model::$fields;
        $this->imageFields = $model::$imageFields;
        $this->docFields = $model::$docFields;
        $this->dateFields = $model::$dateFields;
        $this->urlFields = $model::$urlFields;
        $this->booleanFields = $model::$booleanFields;
        View::share(array(
            'pageUrl' => $this->pageUrl,
            'pageName' => $this->pageName,
            'pageItem' => $this->pageItem,
        ));
    }

    public function index($username){
        $record=PageModel::where('username',$username)->firstOrFail();
        return view('users/index',compact('record'));

    }

    public function edit($id){
        $record=PageModel::where('id',$id)->firstOrFail();
        return view($this->pageUrl.'.edit',compact('record'));
    }

    public function update(Request $request, $id){
        $record=PageModel::find($id);
        foreach($this->fields as $field){
            $record->$field = $request->get($field);
        }
        $record->save();
        return redirect()->back();
    }

    public function update_photo(Request $request, $id){
        $record=PageModel::where('id',$id)->firstOrFail();

        if($request->hasFile('image_url')){
            $imageField=$this->imageFields[0];
            parent::handleImageUpload(
                $record,
                $imageField['naming'],
                $imageField['diff'],
                $request->file('image_url'),
                $imageField['name'],
                $imageField['width'],
                $imageField['height']
                );
            $record->save();
            return redirect()->back();
        }

    }

    public function update_main_image(Request $request, $id){
        $record=PageModel::where('id',$id)->firstOrFail();
        if($request->hasFile('main_image')){
            $imageField=$this->imageFields[1];
            parent::handleImageUpload(
                $record,
                $imageField['naming'],
                $imageField['diff'],
                $request->file('main_image'),
                $imageField['name'],
                $imageField['width'],
                $imageField['height']
            );
            $record->save();
            return redirect()->back();
        }
    }
}
