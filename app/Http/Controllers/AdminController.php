<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function doctorList(){
        if(Auth::id()){
            $doctors = Doctor::paginate(10);
            $specialty = ["Anatomical Pathology", "Anesthesiology", "Cardiology", "Cardiovascular/Thoracic Surgery", "Clinical Immunology/Allergy", "Critical Care Medicine", "Dermatology", "Diagnostic Radiology", "Emergency Medicine", "Endocrinology and Metabolism", "Family Medicine", "Gastroenterology", "General Internal Medicine", "General Surgery", "General/Clinical Pathology", "Geriatric Medicine", "Hematology", "Medical Biochemistry", "Medical Genetics", "Medical Microbiology and Infectious Diseases", "Medical Oncology", "Nephrology", "Neurology", "Neurosurgery", "Nuclear Medicine", "Obstetrics/Gynecology", "Occupational Medicine", "Ophthalmology", "Orthopedic Surgery", "Otolaryngology", "Pediatrics", "Physical Medicine and Rehabilitation", "Plastic Surgery", "Psychiatry", "Public Health and Preventive Medicine", "Radiation Oncology", "Respirology", "Rheumatology", "Urology"];
            return view('admin.doctors_list')->with(['doctors'=>$doctors,'specialties'=>$specialty]);
        }
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

}