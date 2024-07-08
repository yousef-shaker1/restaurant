<div class="register-container">
    <h2 class="text-center">Register</h2>
    @if (Session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session()->get('add') }}</strong>
        </div>
    @endif

    <form action="{{ route('customer.store') }}" method="post">
        @csrf
        <div class="form-group">
            {{-- <label for="name">Name</label> --}}
            <input type="text" class="form-control" wire:model.live="name" id="name" name="name" placeholder="Enter your name" required>
            @error('name')<div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            {{-- <label for="email">Email</label> --}}
            <input type="email" class="form-control" wire:model.live="email" id="email" name="email" placeholder="Enter your email" required>
            @error('email')<div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            {{-- <label for="password">Password</label> --}}
            <input type="password" class="form-control" wire:model.live="password" id="password" name="password" placeholder="Enter your password" required>
            @error('password')<div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            {{-- <label for="phone">Phone Number</label> --}}
            <input type="tel" class="form-control" id="phone" name="phone" wire:model.live="phone" placeholder="Enter your phone number" required>
            @error('phone')<div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            {{-- <label for="dob">Date of Birth</label> --}}
            <input type="date" class="form-control" id="dob" wire:model.live="date" name="date" required>
            @error('date')<div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            {{-- <label for="address">Address</label> --}}
            <input type="text" class="form-control" id="address" wire:model.live="address" name="address" placeholder="Enter your address" required>
            @error('address')<div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
    <a href="{{ route('login') }}">you have an account? login</a>
    
</div>
