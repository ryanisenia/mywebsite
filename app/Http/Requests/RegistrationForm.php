<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Plan;
use Stripe\Customer;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */



    public function authorize()
    {
        return !! $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripeEmail'=>'required|email',
            'stripeToken'=>'required',
            'plan'=>'required'

        ];
    }


    public function save()
    {



           $plan=Plan::findorFail($this->plan);

           $this->user()
                ->subsciption()
                ->create($plan, $this->stripeToken);

          
            
          
        
    }
}
