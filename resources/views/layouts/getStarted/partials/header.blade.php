<div class="col-md-12 px-5 py-2 d-flex justify-content-between bg-white">
    <div class="d-flex align-items-center">

        <img src="{{ asset('public/assets/images/logo.png') }}" class="header-img" alt="FitBite" style="height: 50px;" />
    </div>
    <div class="side-header d-flex align-items-center">

        <p onclick="changeLang()" style="cursor:pointer">@if(\App::getLocale() == 'en')
            العربية
          @else
             English
          @endif</p>
    </div>

<form style="display:none" action="{{route('change-language')}}" method="POST" class="change_lang_form">
@csrf
<input type="hidden" name="locale" value="@if(\App::getlocale() == 'ar') en @else ar @endif">
</form>
</div>

<script>
function changeLang(){
document.querySelector('.change_lang_form').submit();
}
</script>
