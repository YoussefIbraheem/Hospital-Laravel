<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Notifications\appointmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function doctorList(){
            
            $doctors = Doctor::paginate(10);
            $specialty = ["Anatomical Pathology", "Anesthesiology", "Cardiology", "Cardiovascular/Thoracic Surgery", "Clinical Immunology/Allergy", "Critical Care Medicine", "Dermatology", "Diagnostic Radiology", "Emergency Medicine", "Endocrinology and Metabolism", "Family Medicine", "Gastroenterology", "General Internal Medicine", "General Surgery", "General/Clinical Pathology", "Geriatric Medicine", "Hematology", "Medical Biochemistry", "Medical Genetics", "Medical Microbiology and Infectious Diseases", "Medical Oncology", "Nephrology", "Neurology", "Neurosurgery", "Nuclear Medicine", "Obstetrics/Gynecology", "Occupational Medicine", "Ophthalmology", "Orthopedic Surgery", "Otolaryngology", "Pediatrics", "Physical Medicine and Rehabilitation", "Plastic Surgery", "Psychiatry", "Public Health and Preventive Medicine", "Radiation Oncology", "Respirology", "Rheumatology", "Urology"];
            return view('admin.doctors_list')->with(['doctors'=>$doctors,'specialties'=>$specialty]);

    }

    public function addDoctor(Request $request){
        $data = $request->validate([
            'name'=>'required|max:50',
            'phone'=>'required|max:15',
            'room_no'=>'required|numeric|min:1|max:300',
            'specialty'=>'required',
            'profile_pic'=>'required|image|mimes:jpg,bmp,png',
        ]);
        $request->profile_pic = Storage::putFile('doctors',$request->profile_pic);
        Doctor::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'room_no'=>$request->room_no,
            'specialty'=>$request->specialty,
            'profile_pic'=>$request->profile_pic
        ]);
        session()->flash('success','Information added successfully');
        return redirect()->back();
    }

    public function deleteDoctor ($id){

        $doctor = Doctor::findOrFail($id);
        Storage::delete($doctor->profile_pic);
        $doctor->delete();
        session()->flash('deleteSuccess','Information deleted successfully');
        return redirect()->back();
    }

    public function editDoctor($id){
        $editDoctor = Doctor::findOrFail($id);
        return redirect(url('/view_doctors'))->with(['editDoctor'=>$editDoctor]);

    }

    public function updateDoctor($id , Request $request){
        $updateDoctor = Doctor::findOrFail($id);
        $dataUpdate = $request->validate([
            'nameUpdate'=>'required|max:50',
            'phoneUpdate'=>'required|max:15',
            'room_noUpdate'=>'required|numeric|min:1|max:300',
            'specialtyUpdate'=>'required',
            'profile_picUpdate'=>'image|mimes:jpg,bmp,png',
        ]);
        if($request->has('profile_picUpdate')){
            Storage::delete($updateDoctor->profile_pic);
            $request->profile_picUpdate = Storage::putFile('doctors',$request->profile_picUpdate);
        }else{
            $request->profile_picUpdate =  $updateDoctor->profile_pic;
        }

        $updateDoctor->update([
            'name'=>$request->nameUpdate,
            'phone'=>$request->phoneUpdate,
            'room_no'=>$request->room_noUpdate,
            'specialty'=>$request->specialtyUpdate,
            'profile_pic'=>$request->profile_picUpdate,
        ]);
        session()->flash('deleteSuccess','Information deleted successfully');
        return redirect()->back();
    }

    public function viewAppointments(){
        $appointmentList = Appointment::paginate(10);
        return view('admin.appointments',compact('appointmentList'));
    }

    public function statusApproved($id){
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();
        return redirect()->back();

    }

    public function statusRejected($id){
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();
        return redirect()->back();

    }

    public function sendEmail($id){
        $data = Appointment::findOrFail($id);
        Notification::send($data, new appointmentNotification($data));
        return redirect()->back(); 
    }


}
