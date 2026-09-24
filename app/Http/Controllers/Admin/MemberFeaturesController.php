<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AnnouncementDataTable;
use App\Http\Controllers\Controller;
use App\Services\FeaturesService;
use Illuminate\Http\Request;
use App\Models\Announcement;

class MemberFeaturesController extends Controller
{
    public function announcements(AnnouncementDataTable $dataTable){
       return $dataTable->render('admin.features.announcements');
    }
    public function announcementCreate(Request $request){
        if($request->isMethod('post')){
            return (new FeaturesService)->storeAnnouncement($request);
        }
        $id = request()->get('id') ?? null;
        $announcement = null;
        if($id != null){
            $announcement = Announcement::find(decrypt($id));
        }
        return ['status' => true,'html' => view('admin.features.announcement-create',compact('announcement'))->render()];
    }

    public function announcementDestroy($id) {
        try {
            $announcement = Announcement::find(decrypt($id));
            if ($announcement && $announcement->delete()) {
                return response()->json(['status' => true,'message' => 'Announcement has been deleted successfully','code' => 200]);
            }
            return response()->json(['status' => false,'message' => 'Announcement not found','code' => 400]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message' => $th->getMessage(),'code' => 400]);
        }
    }
}
