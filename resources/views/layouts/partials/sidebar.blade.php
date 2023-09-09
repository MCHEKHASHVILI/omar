<!-- Sidebar -->
<style>
.activeSideBarLink{
   background: #fae5e5ad;
   font-weight: bold;
   color: #000;
}
</style>

@php 
$currentUrl = url()->current();
@endphp
<div class="sidebar p-0">
    <span class="close-button"><i class="fa fa-times"></i></span>
    <nav>
        <div class="navbar">
            <div class="logo">
                <a href=""><img src="{{ asset('public/assets/images/logo.png') }}" alt=""></a>
                <x-side-bar-profile-section />  
            </div>
            <ul>
                <li><a @if($currentUrl == URL('home')) class="activeSideBarLink" @endif href="{{ URL('home') }}">
                        <!-- <i class="fas fa-home"></i> -->
                        <img src="{{ asset('public/assets/images/home.png') }}" class="nav-icon" />
                        <span class="nav-item">{{Str::upper(trans('messages.home'))}}</span>
                    </a>
                </li>
                <li><a  @if($currentUrl == URL(config('constants.TRAININGS.CATEGORIZED'))) class="activeSideBarLink" @endif href="{{ URL(config('constants.TRAININGS.CATEGORIZED')) }}">
                        <!-- <i class=""></i> -->
                        <img src="{{ asset('public/assets/images/workout.png') }}" class="nav-icon1" />
                        <span class="nav-item">{{Str::upper(trans('messages.workout_videos'))}}</span>
                    </a>
                </li>
                <li><a    @if($currentUrl == URL(config('constants.RECIPES.CATEGORIZED'))) class="activeSideBarLink" @endif  href="{{ URL(config('constants.RECIPES.CATEGORIZED')) }}">
                        <!-- <i class="fas fa-utensils"></i>  -->
                        <img src="{{ asset('public/assets/images/recipe.png') }}" class="nav-icon" />
                        <span class="nav-item">{{Str::upper(trans('messages.recipe_video'))}}</span>
                    </a>
                </li>
                <li><a  @if($currentUrl == URL('profile')) class="activeSideBarLink" @endif  href="{{ URL('profile') }}">
                        <!-- <i class="fas fa-user-circle"></i> -->
                        <img src="{{ asset('public/assets/images/account.png') }}" class="nav-icon" />
                        <span class="nav-item">{{Str::upper(trans('messages.my_account'))}}</span>
                    </a>
                </li>

                <li><a class="logout cursor-pointer">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">{{Str::upper(trans('messages.logout'))}}</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</div>


<script>
document.querySelector('a.logout').addEventListener('click', function(){
firebase.auth().signOut().then(() => {
  location.href="/"
}).catch((error) => {
  // An error happened.
});

})
</script>
