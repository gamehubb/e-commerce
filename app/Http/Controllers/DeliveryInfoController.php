<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryInfo;
use Auth;

class DeliveryInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $deliveryInfo = DeliveryInfo::where('user_id', $userId)->get();
        $context = ['deliveryInfo' => $deliveryInfo];
        return view('deliveryInfo.index', $context);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliveryInfo.create');
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        if($request->township == 'လှိုင်သာယာ' || $request->township == 'ဒလ' 
            || $request->township == 'ရွှေပြည်သာ' || $request->township == 'လှည်းကူး'
            || $request->township == 'ထောက်ကြန့်' || $request->township == 'သန်လျင်' ){
                $delivery_fees = 3500;
            }else if($request->city == "ရန်ကုန်တိုင်းဒေသကြီး ရန်ကုန်မြို့"){
                $delivery_fees = 2000;
            }else if($request->city == "ရန်ကုန်တိုင်းဒေသကြီး အခြားမြို့များ"){
                $delivery_fees = 3500;
            }else if($request->township == "တပ်ကုန်း" || $request->township == "တောင်ညို"){
                $delivery_fees = 4900;
            
            }else if($request->city == "ကချင်ပြည်နယ်" || $request->city == "တနသာ်ရီတိုင်းဒေသကြီး" || $request->city == "ရခိုင်ပြည်နယ်" ){
                $delivery_fees = 5500;
            }else if($request->city == "ရှမ်းပြည်နယ် တောင်ကြီးမြို့" || $request->city == "ရှမ်းပြည်နယ်"){
                $delivery_fees = 4900;
            
            }else{
                $delivery_fees = 3900;
            }
        DeliveryInfo::create([
            'user_id' => $userId,
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'city' => $request->city,
            'delivery_fees' => $delivery_fees,
            'township' => $request->township,
            'state_region' => $request->state_region,
        ]);

        return redirect('checkout/'.Auth::getUser()->name);
    }

    public function getTownshipInfo($id)
    {
        if($id == 'ရန်ကုန်တိုင်းဒေသကြီး ရန်ကုန်မြို့'){

            return response()->json([
                'လမ်းမတော်' => 'လမ်းမတော်',
                'လသာ'  => 'လသာ',
                'ပန်းပဲတန်း' => 'ပန်းပဲတန်း',
                'ကျောက်တံတား' => 'ကျောက်တံတား',
                'ပုဇွန်တောင်' => 'ပုဇွန်တောင်',
                'ဗိုလ်တထောင်' => 'ဗိုလ်တထောင်',
                'ဒဂုံ' => 'ဒဂုံ',
                'ဗဟန်း' => 'ဗဟန်း',
                'သာကေတ' => 'သာကေတ',
                'အလုံ' => 'အလုံ',
                'စမ်းချောင်း' => 'စမ်းချောင်း',
                'ကြည့်မြင်တိုင်' => 'ကမာရွတ်',
                'အင်းစိန်' => 'အင်းစိန်',
                'လှိုင်' => 'လှိုင်',
                'မရမ်းကုန်း' => 'မရမ်းကုန်း',
                'တာမွေ' => 'တာမွေ',
                'သက်န်းကျွန်း' => 'သက်န်းကျွန်း',
                'မဂ်လာတောင်ညွန့်' => 'မဂ်လာတောင်ညွန့်',
                'ဒေါပုံ' => 'ဒေါပုံ',
                'ရန်ကင်း' => 'ရန်ကင်း',
                'မြောက်ဥက္ကလာပ' => 'မြောက်ဥက္ကလာပ',
                'တောင်ဥက္ကလာပ' => 'တောင်ဥက္ကလာပ',
                'တောင်ဒဂုံ' => 'တောင်ဒဂုံ',
                'မြောက်ဒဂုံ' => 'မြောက်ဒဂုံ',
                'အရှေ့ဒဂုံ' => 'အရှေ့ဒဂုံ',
                'ဒဂုံဆိပ်ကမ်း' => 'ဒဂုံဆိပ်ကမ်း',
                'ရွှေပေါက်ကံ' => 'ရွှေပေါက်ကံ',
                'မဂ်လာဒုံ' => 'မဂ်လာဒုံ',
                'တိုက်ကြီး' => 'တိုက်ကြီး',
                'ကျောက်တန်း' => 'ကျောက်တန်း',
                'ထန်းတပင်' => 'ထန်းတပင်',
                'ကော့မှုး' => 'ကော့မှုး',
                'ခရမ်း' => 'ခရမ်း',
                'သုံးခွ' => 'သုံးခွ',
                'တွံတေး' => 'တွံတေး',
                'ဆိပ်ကြီးခနောင်တို' => 'ဆိပ်ကြီးခနောင်တို'

            ]);

        }else if($id == 'ရန်ကုန်တိုင်းဒေသကြီး အခြားမြို့များ'){

            return response()->json([

                'ဒလ' => 'ဒလ',
                'လှိုင်သာယာ' => 'လှိုင်သာယာ',
                'ရွှေပြည်သာ' => 'ရွှေပြည်သာ',
                'သန်လျင်' => 'သန်လျင်',
                'လှည်းကူး' => 'လှည်းကူး',
                'ထောက်ကြန့်' => 'ထောက်ကြန့်',
                'မြောက်ဥက္ကလာပ' => 'မြောက်ဥက္ကလာပ',
                'တောင်ဥက္ကလာပ' => 'တောင်ဥက္ကလာပ',
                'တောင်ဒဂုံ' => 'တောင်ဒဂုံ',
                'မြောက်ဒဂုံ' => 'မြောက်ဒဂုံ',
                'အရှေ့ဒဂုံ' => 'အရှေ့ဒဂုံ',
                'ဒဂုံဆိပ်ကမ်း' => 'ဒဂုံဆိပ်ကမ်း',
                'ရွှေပေါက်ကံ' => 'ရွှေပေါက်ကံ',
                'မဂ်လာဒုံ' => 'မဂ်လာဒုံ',
                'တိုက်ကြီး' => 'တိုက်ကြီး',
                'ကျောက်တန်း' => 'ကျောက်တန်း',
                'ထန်းတပင်' => 'ထန်းတပင်',
                'ကော့မှုး' => 'ကော့မှုး',
                'ခရမ်း' => 'ခရမ်း',
                'သုံးခွ' => 'သုံးခွ',
                'တွံတေး' => 'တွံတေး',
                'ဆိပ်ကြီးခနောင်တို' => 'ဆိပ်ကြီးခနောင်တို'
                
            ]);

        }else if($id == 'ပဲခူးတိုင်းဒေသကြီး'){

            return response()->json([

                "ပဲခူး" => "ပဲခူး",
                "ဒိုက်ဦး" => "ဒိုက်ဦး",
                "ကြို့ပင်ကောက်" => "ကြို့ပင်ကောက်",
                "လက်ပတန်း" => "လက်ပတန်း",
                "နတ်တလင်း" => "နတ်တလင်း",
                "ညောင်လေးပင်" => "ညောင်လေးပင်",
                "ပေါင်းတည်" => "ပေါင်းတည်",
                "ပြည်"   => "ပြည်",
                "တောင်ငူ" => "တောင်ငူ",
                "သာယာဝတီ" => "သာယာဝတီ",
                "ဝေါ" =>  "ဝေါ",
                "ဇီးကုန်း" => "ဇီးကုန်း",
                "​ဖြူး" => "​ဖြူး"
                
            ]);

        }else if($id == 'ပဲခူးတိုင်းဒေသကြီး တောင်ငူမြို့'){

            return response()->json([

                "အုတ်တွင်း" => "အုတ်တွင်း",
                "တောင်ငူ" => "တောင်ငူ",
                "ရေတာရှည်" => "ရေတာရှည်"
            ]);

        }else if($id == 'ပဲခူးတိုင်းဒေသကြီး သာယာဝတီမြို့'){

        return response()->json([

            "အုတ်ဖို" => "အုတ်ဖို",
            "တောင်ငူ" => "တောင်ငူ",
            "သာယာဝတီ" => "သာယာဝတီ"
        ]);

        }else if($id == 'ဧရာဝတီတိုင်းဒေသကြီး'){

        return response()->json([

            "ဘိုကလေး" => "ဘိုကလေး",
            "ဒေးဒရဲ" => "ဒေးဒရဲ",
            "အိမ်မဲ" => "အိမ်မဲ",
            "ဟသ်ာတ" => "ဟသ်ာတ",
            "ကျိုက်လတ်" => "ကျိုက်လတ်",
            "ကြံခင်း" => "ကြံခင်း",
            "ကျောင်းကုန်း" => "ကျောင်းကုန်း", 
            "ကျုံပျော်" => "ကျုံပျော်",
            "လပွတ္တာ" => "လပွတ္တာ",
            "မအူပင်" => "မအူပင်",
            "မော်လမြိုင်ကျွန်း" => "မော်လမြိုင်ကျွန်း",
            "မြန်အောင်" => "မြန်အောင်",
            "မြောင်းမြ" => "မြောင်းမြ",
            "ညောင်တုန်း" => "ညောင်တုန်း",
            "ပန်းတနော်" => "ပန်းတနော်",
            "ပုသိမ်" => "ပုသိမ်",
            "ဖျာပုံ" => "ဖျာပုံ",
            "ဝါးခယ်မ" => "ဝါးခယ်မ",
            "ရေကြည်" => "ရေကြည်",
            "ဇလွန်" => "ဇလွန်"

        ]);

    }else if($id == 'မန္တလေးတိုင်းဒေသကြီး'){

        return response()->json([

            "အမရပူရ" => "အမရပူရ",
            "ကျောက်ပန်းတောင်း" => "ကျောက်ပန်းတောင်း",
            "ကျောက်ဆည်" => "ကျောက်ဆည်",
            "ဟသ်ာတ" => "ဟသ်ာတ",
            "မတ္တရာ" => "မတ္တရာ",
            "မန္တလေး" => "မန္တလေး",
            "ကျောင်းကုန်း" => "ကျောင်းကုန်း", 
            "မိတ္တီလာ" => "မိတ္တီလာ",
            "မိုးကုတ်" => "မိုးကုတ်",
            "မြင်းခြံ" => "မြင်းခြံ",
            "ညောင်ဦး" => "ညောင်ဦး",
            "ပုသိမ်ကြီး" => "ပုသိမ်ကြီး",
            "ပျော်ဘွယ်" => "ပျော်ဘွယ်",
            "ပြင်ဦးလွင်" => "ပြင်ဦးလွင်",
            "စဥ့်ကူ" => "စဥ့်ကူ",
            "စဥ့်ကိုင်" => "စဥ့်ကိုင်",
            "တံတားဦး" => "တံတားဦး",
            "သာစည်" => "သာစည်",
            "ဝမ်းတွင်း" => "ဝမ်းတွင်း",
            "ရမည်းသင်း" => "ရမည်းသင်း"

        ]);

        }else if($id == 'မန္တလေးတိုင်းဒေသကြီး မန္တလေးမြို့'){

        return response()->json([

            "အောင်မြေသာစံ" => "အောင်မြေသာစံ",
            "ချမ်းအေးသာစံ" => "ချမ်းအေးသာစံ",
            "ချမ်းမြသာစည်" => "ချမ်းမြသာစည်",
            "မဟာအောင်မြေ" => "မဟာအောင်မြေ",
            "ပြည်ကြီးတံခွန်" => "ပြည်ကြီးတံခွန်",
            "မန္တလေး" => "မန္တလေး",
            "ကျောင်းကုန်း" => "ကျောင်းကုန်း", 
            "မိတ္တီလာ" => "မိတ္တီလာ",
            "မိုးကုတ်" => "မိုးကုတ်",
            "မြင်းခြံ" => "မြင်းခြံ",
            "ညောင်ဦး" => "ညောင်ဦး",
            "ပုသိမ်ကြီး" => "ပုသိမ်ကြီး",
            "ပျော်ဘွယ်" => "ပျော်ဘွယ်",
            "ပြင်ဦးလွင်" => "ပြင်ဦးလွင်",
            "စဥ့်ကူ" => "စဥ့်ကူ",
            "စဥ့်ကိုင်" => "စဥ့်ကိုင်",
            "တံတားဦး" => "တံတားဦး",
            "သာစည်" => "သာစည်",
            "ဝမ်းတွင်း" => "ဝမ်းတွင်း",
            "ရမည်းသင်း" => "ရမည်းသင်း"

        ]);

        }else if($id == 'မန္တလေးတိုင်းဒေသကြီး ညောင်ဦးမြို့'){

        return response()->json([

            "ပုဂံ" => "ပုဂံ",
            "ညောင်ဦး" => "ညောင်ဦး",
            
        ]);

        }else if($id == 'နေပြည်တော်တိုင်းဒေသကြီး နေပြည်တော်မြို့'){

        return response()->json([

            "ဒက္ခိဏသီရိ" => "ဒက္ခိဏသီရိ",
            "လယ်ဝေး" => "လယ်ဝေး",
            "ပုဗ္ဗသီရိ" => "ပုဗ္ဗသီရိ",
            "ပျဥ်းမနား" => "ပျဥ်းမနား",
            "ဇေယျာသီရိ" => "ဇေယျာသီရိ",
            "တပ်ကုန်း" => "တပ်ကုန်း"

            
        ]);

        }else if($id == 'စစ်ကိုင်းတိုင်းဒေသကြီး'){

            return response()->json([

                "ကလေး" => "ကလေး",
                "ကန့်ဘလူ" => "ကန့်ဘလူ",
                "ကသာ" => "ကသာ",
                "မုံရွာ" => "မုံရွာ",
                "မြင်းမူ" => "မြင်းမူ",
                "စစ်ကိုင်း" => "စစ်ကိုင်း",
                "ဆားလင်းကြီး" => "ဆားလင်းကြီး",
                "ရွှေဘို" => "ရွှေဘို",
                "တမူး" => "တမူး",
                "ဝန်သို" => "ဝန်သို",
                "ယင်းမာပင်" => "ယင်းမာပင်",
            ]);
        
        }else if($id == 'စစ်ကိုင်းတိုင်းဒေသကြီး ရွှေဘိုမြို့'){

            return response()->json([

                "ရွှေဘို" => "ရွှေဘို",
                "ဒီပဲယင်း" => "ဒီပဲယင်း",
                "တန့်ဆည်" => "တန့်ဆည်",
                "ရေဦး" => "ရေဦး"
            ]);

        }else if($id == 'ရှမ်းပြည်နယ်'){

            return response()->json([

                "အောင်ပန်း" => "အောင်ပန်း",
                "ဟဲဟိုး" => "ဟဲဟိုး",
                "ဟိုပုံး" => "ဟိုပုံး",
                "သီပေါ" => "သီပေါ",
                "ကလော" => "ကလော",
                "ကွမ်းလုံ" => "ကွမ်းလုံ",
                "ကျောက်မဲ" => "ကျောက်မဲ",
                "လာရှိုး" => "လာရှိုး",
                "မူဆယ်" => "မူဆယ်",
                "ညောင်ရွှေ" => "ညောင်ရွှေ",
                "တာချီလိတ်" => "တာချီလိတ်",
                "တောင်ကြီး" => "တောင်ကြီး",


            ]);

        }else if($id == 'ရှမ်းပြည်နယ် တောင်ကြီးမြို့'){

            return response()->json([

                "အေးသာယာစက်မှုဇုံ" => "အေးသာယာစက်မှုဇုံ",
                "ချမ်းမြသာစည် ရပ်ကွက်" => "ချမ်းမြသာစည် ရပ်ကွက်",
                "ချမ်းသာ ရပ်ကွက်" => "ချမ်းသာ ရပ်ကွက်",
                "ဟောကုန်း ရပ်ကွက်" => "ဟောကုန်း ရပ်ကွက်",
                "ဘုရားဖြူ ရပ်ကွက်" => "ဘုရားဖြူ ရပ်ကွက်",
                "ကံအောက် ရပ်ကွက်" => "ကံအောက် ရပ်ကွက်",
                "ကံကြီး ရပ်ကွက်" => "ကံကြီး ရပ်ကွက်",
                "ကံရှေ့ ရပ်ကွက်" => "ကံရှေ့ ရပ်ကွက်",
                "ကံသာ ရပ်ကွက်" => "ကံသာ ရပ်ကွက်",
                "ကျောင်းကြီးစု ရပ်ကွက်" => "ကျောင်းကြီးစု ရပ်ကွက်",
                "လမ်းမတော် ရပ်ကွက်" => "လမ်းမတော် ရပ်ကွက်",
                "မဂ်လာဦး ရပ်ကွက်" => "မဂ်လာဦး ရပ်ကွက်",
                "မြို့မ ရပ်ကွက်" => "မြို့မ ရပ်ကွက်",
                "ညောင်ဖြူစခန်း ရပ်ကွက်" => "ညောင်ဖြူစခန်း ရပ်ကွက်",
                "ညောင်ရွှေဟော်ကုန်း ရပ်ကွက်" => "ညောင်ရွှေဟော်ကုန်း ရပ်ကွက်",
                "ပြည်တော်သာ ရပ်ကွက်" => "ပြည်တော်သာ ရပ်ကွက်",
                "စပ်စံထွန်း ရပ်ကွက်" => "စပ်စံထွန်း ရပ်ကွက်",
                "စိန်ပန်း ရပ်ကွက်" => "စိန်ပန်း ရပ်ကွက်",
                "ရွှေတောင် ရပ်ကွက်" => "ရွှေတောင် ရပ်ကွက်",
                "သစ်တော ရပ်ကွက်" => "သစ်တော ရပ်ကွက်",
                "ရတနာသီရိ ရပ်ကွက်" => "ရတနာသီရိ ရပ်ကွက်",
                "ရေအေးကွင်း ရပ်ကွက်" => "ရေအေးကွင်း ရပ်ကွက်",
                "စျေးပိုင်း ရပ်ကွက်" => "စျေးပိုင်း ရပ်ကွက်"


            ]);

        }else if($id == 'တနသာ်ရီတိုင်းဒေသကြီး'){

            return response()->json([

                "ထားဝယ်" => "ထားဝယ်",
                "ကော့သောင်း" => "ကော့သောင်း",
                "မြိတ်" => "မြိတ်",

            ]);
        }else if($id == 'မွန်ပြည်နယ်'){

            return response()->json([

                "ဘီးလင်း" => "ဘီးလင်း",
                "ကျိုက်မရော" => "ကျိုက်မရော",
                "ကျိုက်ထို" => "ကျိုက်ထို",
                "မော်လမြိုင်" => "မော်လမြိုင်",
                "မုဒုံ" => "မုဒုံ",
                "သံဖြူဇရပ်" => "သံဖြူဇရပ်",
                "သထုံ" => "သထုံ",
                "ရေး" => "ရေး",

            ]);
        }else if($id == 'ရခိုင်ပြည်နယ်'){

            return response()->json([

                "ကျောက်ဖြူ" => "ကျောက်ဖြူ",
                "မင်းပြား" => "မင်းပြား",
                "မြောက်ဦး" => "မြောက်ဦး",
                "စစ်တွေ" => "စစ်တွေ",
                "သံတွဲ" => "သံတွဲ",
            ]);
        }

        else if($id == 'ရခိုင်ပြည်နယ် သံတွဲမြို့'){

            return response()->json([

                "ဂွ" => "ဂွ",
                "သံတွဲ" => "သံတွဲ",
                
            ]);
        }

        else if($id == 'မကွေးတိုင်းဒေသကြီး'){

            return response()->json([

                "အောင်လံ" => "အောင်လံ",
                "ချောက်" => "ချောက်",
                "ဂန့်ဂေါ" => "ဂန့်ဂေါ",
                "မကွေး" => "မကွေး",
                "မင်းဘူး" => "မင်းဘူး",
                "မြိုင်" => "မြိုင်",
                "နတ်မောက်" => "နတ်မောက်",
                "ပခုက္ကူ" => "ပခုက္ကူ",
                "တောင်တွင်းကြီး" => "တောင်တွင်းကြီး",
                "သရက်" => "သရက်",
                "ရေနံချောင်း" => "ရေနံချောင်း",

                
            ]);
        }

        else if($id == 'မကွေးတိုင်းဒေသကြီး မင်းဘူးမြို့'){

            return response()->json([

                "မင်းဘူး" => "မင်းဘူး",
                "ပွင့်ဖြူ" => "ပွင့်ဖြူ",
                "စလင်း" => "စလင်း",

                
            ]);
        }

        else if($id == 'ကရင်ပြည်နယ်'){

            return response()->json([

                "ဘားအံ" => "ဘားအံ",
                "ဖာပွန်" => "ဖာပွန်",
                "မြဝတီ" => "မြဝတီ",

                
            ]);
        }

        else if($id == 'ကချင်ပြည်နယ်'){

            return response()->json([

                "ဗန်းမော်" => "ဗန်းမော်",
                "မိုးညှင်း" => "မိုးညှင်း",
                "မြစ်ကြီးနား" => "မြစ်ကြီးနား",
                "ပူတာအို" => "ပူတာအို",
                
            ]);
        }

        else if($id == 'ကချင်ပြည်နယ် မိုးညှင်းမြို့'){

            return response()->json([

                "ဖားကန့်" => "ဖားကန့်",
                "မိုးကောင်း" => "မိုးကောင်း",
                "မိုးညှင်း" => "မိုးညှင်း",

                
            ]);
        }

        else if($id == 'ချင်းပြည်နယ်'){

            return response()->json([

                "ဟားခါး" => "ဟားခါး",
                "မတူပီ" => "မတူပီ",
                "မင်းတပ်" => "မင်းတပ်",
                "တီးတိန်" => "တီးတိန်",
                
            ]);
        }

        else if($id == 'ချင်းပြည်နယ် မတူပီမြို့'){

            return response()->json([

                "မတူပီ" => "မတူပီ",
                "ပလက်ဝ" => "ပလက်ဝ",
                
            ]);
        }

        if($request->township == 'လှိုင်သာယာ' || $request->township == 'ဒလ' 
            || $request->township == 'ရွှေပြည်သာ' || $request->township == 'လှည်းကူး'
            || $request->township == 'ထောက်ကြန့်' || $request->township == 'သန်လျင်' ){
                $delivery_fees = 3000;
            }else if($request->city == "ရန်ကုန်တိုင်းဒေသကြီး ရန်ကုန်မြို့"){
                $delivery_fees = 2000;
            }else if($request->city == "ရန်ကုန်တိုင်းဒေသကြီး အခြားမြို့များ"){
                $delivery_fees = 3000;
            }else if($request->township == "တပ်ကုန်း" || $request->township == "တောင်ညို"){
                $delivery_fees = 4700;
            
            }else if($request->city == "ကချင်ပြည်နယ်" || $request->city == "တနသာ်ရီတိုင်းဒေသကြီး" || $request->city == "ရခိုင်ပြည်နယ်" ){
                $delivery_fees = 4500;
            }else if($request->city == "ရှမ်းပြည်နယ် တောင်ကြီးမြို့" || $request->city == "ရှမ်းပြည်နယ်"){
                $delivery_fees = 3900;
            
            }else{
                $delivery_fees = 2900;
            }

    }
}