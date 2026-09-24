<a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="commanModel(`{{route('announcements.create',['id' => encrypt($model->id)])}}`,'Edit Announcement')">Edit</a>
<a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="deleteRecord(`{{route('announcements.destroy',['id' => encrypt($model->id)])}}`,'Announcement')">Delete</a>
