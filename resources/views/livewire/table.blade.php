<div>
    <!-- book section -->

<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Book A Table
        </h2>
      </div>
      @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session()->get('message') }}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form method='post' wire:submit.prevent='savedate'>
              <div>
                <input type="text" class="form-control" wire:model.live='name'placeholder="Your Name" name="name" />
                @error('name') <div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div> @enderror
              </div>
              <div>
                <input type="text" class="form-control" wire:model.live='email' placeholder="Your email" name="email" />
                @error('email') <div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div> @enderror
              </div>
              <div>
                <input type="text" class="form-control" wire:model.live="phone" placeholder="Phone Number" name="phone" />
                @error('phone')<div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div> @enderror
              </div>
              <div>
                <select name="count" wire:model.live="count" class="form-control nice-select wide">
                  <option value="" selected>
                    How many persons?
                  </option>
                  <option value="2">
                    2
                  </option>
                  <option value="3">
                    3
                  </option>
                  <option value="4">
                    4
                  </option>
                  <option value="5">
                    5
                  </option>
                  <option value="5">
                    6
                  </option>
                </select>
                @error('count')<div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div> @enderror
              </div>
              <div>
                <input type="date" wire:model.live="date" class="form-control" name="date">
                @error('date')<div class="alert alert-danger alert-dismissible fade show">{{ $message }}</div> @enderror
              </div>
              @if(Auth::user())
              <div class="btn_box">
                <button type='submit'>
                  Book Now
                </button>
              </div>
            </form>
            @else
            <div class="btn_box">
              <a href='{{ route('login') }}' class="btn1">
                login
              </a>
            </div>
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <div id="googleMap"></div>
          </div>
        </div>
      </div>
    </div>
  </section>  <!-- end book section -->
  
</div>
