<?php
namespace App\Services;

use Validator;
use App\Models\Announcement;
use DB;

class FeaturesService{
    
    public function storeAnnouncement($request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }
       
        $data = $request->only('title','description','status');
        if($request->has('status')){
             $data['status'] = $request->status;
        } else {
             // Default to active if not provided? Or handled by DB default. 
             // If checkbox is unchecked it might not send anything, so handle that if needed.
             // But usually for explicit status management we pass it.
        }

        $image = $request->file('image') ?? null;

        try {
            if($image != null){
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('storage/uploads/announcements/'), $imageName);
                $data['image'] = $imageName;
            }
            if($request->has('id')){
                $Announcement = Announcement::find($request->id);
                $Announcement->update($data);
                return response()->json(['status' => true,'modal' => true,'message' => 'Announcement has been updated successfully','code' => 200]);
            }else{
                $Announcement = Announcement::create($data);
                if($Announcement){
                    return response()->json(['status' => true,'modal' => true,'message' => 'Announcement has been added successfully','code' => 200]);
                }
            }
            throw new \Exception("Error Processing Request", 1);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message' => $th->getMessage(),'code' => 400]);
        }
    }
}
