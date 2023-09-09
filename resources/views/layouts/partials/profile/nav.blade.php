  <nav>
      <div class="navbar">
          <div class="logo">
              <img src="{{ asset('assets/images/logo.png') }}" alt="">
              <div class="image-upload">
                  <label for="file-input">
                      <img src="{{ asset('assets/images/fileinput.png') }}" />
                  </label>
                  <input id="file-input" type="file" />
                  <p class="file-name">Nabil Attia</p>
                  <p class="file-membership">{{__('messages.upgrade')}}</p>
              </div>
          </div>
          <ul>
              <li><a href="#">
                      <!-- <i class="fas fa-home"></i> -->
                      <img src="{{ asset('assets/images/home.png') }}" class="nav-icon" />
                      <span class="nav-item">Home</span>
                  </a>
              </li>
              <li><a href="#">
                      <!-- <i class=""></i> -->
                      <img src="{{ asset('assets/images/workout.png') }}" class="nav-icon1" />
                      <span class="nav-item">Workout Videos</span>
                  </a>
              </li>
              <li><a href="#">
                      <!-- <i class="fas fa-utensils"></i>  -->
                      <img src="{{ asset('assets/images/recipe.png') }}" class="nav-icon" />
                      <span class="nav-item">Reciepe Videos</span>
                  </a>
              </li>
              <li><a href="#">
                      <!-- <i class="fas fa-user-circle"></i> -->
                      <img src="{{ asset('assets/images/account.png') }}" class="nav-icon" />
                      <span class="nav-item">My Accouont</span>
                  </a>
              </li>

              <li><a href="#" class="logout">
                      <i class="fas fa-sign-out-alt"></i>
                      <span class="nav-item">Logout</span>
                  </a>
              </li>
              
          </ul>
      </div>
  </nav>
