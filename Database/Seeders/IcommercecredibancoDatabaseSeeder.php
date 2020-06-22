<?php

namespace Modules\Icommercecredibanco\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Icommerce\Entities\PaymentMethod;

class IcommercecredibancoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $options['init'] = "Modules\Icommercecredibanco\Http\Controllers\Api\IcommerceCredibancoApiController";

        $options['mainimage'] = null;
        $options['user'] = "";
        $options['password'] = "";
        $options['mode'] = "sandbox";

       
        $titleTrans = 'icommercecredibanco::icommercecredibancos.single';
        $descriptionTrans = 'icommercecredibanco::icommercecredibancos.description';

        foreach (['en', 'es'] as $locale) {

            if($locale=='en'){
                $params = array(
                    'title' => trans($titleTrans),
                    'description' => trans($descriptionTrans),
                    'name' => config('asgard.icommercecredibanco.config.paymentName'),
                    'active' => 0,
                    'options' => $options
                );

                $paymentMethod = PaymentMethod::create($params);
                
            }else{

                $title = trans($titleTrans,[],$locale);
                $description = trans($descriptionTrans,[],$locale);

                $paymentMethod->translateOrNew($locale)->title = $title;
                $paymentMethod->translateOrNew($locale)->description = $description;

                $paymentMethod->save();
            }

        }// Foreach

        
    }
}