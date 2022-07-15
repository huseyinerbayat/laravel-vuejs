<?php

namespace App\Http\Controllers\Api;

use App\Events\FamilyRegisterEvent;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Repositories\FamilyRepository;
use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $studentRepository;
    private $userRepository;
    private $familyRepository;

    public function __construct(StudentRepository $studentRepository,
        UserRepository $userRepository,
        FamilyRepository $familyRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
        $this->familyRepository = $familyRepository;
    }

    public function get(Request $request){
        $user = $request->user();
        if(!$user){
            $response = ['message' => 'Kullanıcı bulunamadı!'];
            return response()->json($response, 404);
        }
        $family = $user->family; // kullanıcının veli bilgilerinin görüntülenmesi için
        $students = $family->students; // veliye ait öğrenvilerin görüntülenmesi için
        $response = ['user'=> $user];
        return response()->json($response);
    }

    public function login(Request $request){
        $data = $request->only('email', 'password');
        $user = User::where('email', $data['email'])->first();
        if(!$user){
            $response = ['message' => 'Kullanıcı bulunamadı!'];
            return response()->json($response, 404);
        }
        if(Hash::check($data["password"], $user->password)){
            $token = $user->createToken('Access Token')->accessToken;
            $response = ['access_token' => $token];
            return response()->json($response, 200);
        }else{
            $response = ['message' => 'Parola hatalı!'];
            return response()->json($response, 401);
        }
    }

    public function register(Request $request){
        $registration_code = $request->registration_code;
        $family_infos = $request->only('name', 'surname', 'phone_number', 'address');
        $user_infos = $request->only('email', 'password');

        $student = $this->studentRepository->getStudentByRegistrationCode($registration_code);

        if(!$student){
            $response = ['message' => 'Öğrenci bulunamadı!'];
            return response()->json($response, 404);
        }
        if($student->family_id){
            $response = ['message' => 'Öğrenci\'nin mevcut bir velisi var!'];
            return response()->json($response, 200);
        }

        $user = $this->userRepository->register($user_infos); // kullanıcı kaydı
     
        $family = $this->familyRepository->create($user, $family_infos); // kullanıcaya ait veli bilgilerinin oluşturulması

        $this->studentRepository->assignFamily($student, $family); // öğrenciye veli atamasının yapılması

        event(new FamilyRegisterEvent($user, $student));
        $response = ['message' => 'Kayıt başarıyla gerçekleştirildi!'];
        return response()->json($response, 200);
    }

    public function updateinfo(Request $request){
        $infos = $request->only('name', 'surname', 'phone_number', 'address');
        $user = $request->user();
        if(!$user){
            $response = ['message' => 'Geçersiz token!'];
            return response()->json($response, 401);
        }

        $family = $this->familyRepository->update($user, $infos);

        $response = [
            'type' => 'success',
            'message' => 'Bilgileriniz başarıyla güncellendi!',
            'user' => $user,
            'family' => $family
        ];
        return response()->json($response, 200);
    }

    public function list(){
        $students = $this->studentRepository->getStudentsWithFamily();
        $response = ['students' => $students];
        return response()->json($response, 200);
    }
}
