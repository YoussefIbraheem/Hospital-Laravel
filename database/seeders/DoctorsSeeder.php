<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $imgPath = public_path("user-assets/img/doctors");
        $imgs = collect(scandir($imgPath))->slice(2);
        $faker = Factory::create();
        for($i=1;$i<=5;$i++){
        Doctor::create([
            'name'=>$faker->name(),
            'phone'=>$faker->e164PhoneNumber(),
            'specialty'=>$faker->randomElement(["Anatomical Pathology", "Anesthesiology", "Cardiology", "Cardiovascular/Thoracic Surgery", "Clinical Immunology/Allergy", "Critical Care Medicine", "Dermatology", "Diagnostic Radiology", "Emergency Medicine", "Endocrinology and Metabolism", "Family Medicine", "Gastroenterology", "General Internal Medicine", "General Surgery", "General/Clinical Pathology", "Geriatric Medicine", "Hematology", "Medical Biochemistry", "Medical Genetics", "Medical Microbiology and Infectious Diseases", "Medical Oncology", "Nephrology", "Neurology", "Neurosurgery", "Nuclear Medicine", "Obstetrics/Gynecology", "Occupational Medicine", "Ophthalmology", "Orthopedic Surgery", "Otolaryngology", "Pediatrics", "Physical Medicine and Rehabilitation", "Plastic Surgery", "Psychiatry", "Public Health and Preventive Medicine", "Radiation Oncology", "Respirology", "Rheumatology", "Urology"]),
            'room_no'=>$faker->numberBetween(1,100),
            'profile_pic'=>"doctors/".$faker->randomElement($imgs)
        ]);
    }
    }
}
