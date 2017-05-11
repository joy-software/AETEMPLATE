<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 09/05/2017
 * Time: 15:43
 */
<br>
<script async src="https://www.wecashup.cloud/live/2-form/js/MobileMoney.js" class="wecashup_button"
    data-receiver-uid={{env('WCU_IDENTIFIANT_MARCHAND')}}
    data-receiver-public-key={{env('WCU_CLE_PUBLIQUE_MARCHAND')}}
    data-transaction-receiver-total-amount="MONTANT_TOTAL_DE_LA_TRANSACTION"
    data-transaction-receiver-currency="{{env('WCU_DEVISE_DU_MARCHAND')}}"
    data-name={{config('app.name')}}
    data-transaction-receiver-reference="REFERENCE_DE_LA_TRANSACTION_CHEZ_LE_MARCHAND"
    data-transaction-sender-reference="REFERENCE_DE_LA_TRANSACTION_CHEZ_LE_CLIENT"
    data-style="1"
    data-image="https://www.wecashup.cloud/live/2-form/img/home.png"
    data-cash="true"
    data-telecom="true"
    data-m-wallet="false"
    data-split="false"
    data-sender-lang="fr"
data-sender-phonenumber="{{$avatar->phone}}">
</script>