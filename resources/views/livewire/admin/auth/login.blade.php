<div>

    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">

        <div class="card border-0 shadow-lg rounded-4" style="max-width: 420px; width:100%;">
            <div class="card-body p-4 p-md-5">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <span class="badge rounded-circle bg-dark p-3 fs-4">
                            <i class="bi bi-shield-lock"></i>
                        </span>
                    </div>

                    <h3 class="fw-bold mb-1">Admin Login</h3>
                    <p class="text-muted small">
                        Sign in to continue to dashboard
                    </p>
                </div>

                <form wire:submit.prevent="login">

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email address</label>
                        <input type="email" wire:model.defer="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="admin@example.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" wire:model.defer="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" wire:model="remember" class="form-check-input" id="remember">
                            <label class="form-check-label small" for="remember">
                                Remember me
                            </label>
                        </div>

                        <a href="#" class="small text-decoration-none">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Button -->
                    <button type="submit" class="btn btn-dark btn-lg w-100">
                        Login
                    </button>

                </form>

                <!-- Footer -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        © {{ date('Y') }} Admin Panel
                    </small>
                </div>

            </div>
        </div>

    </div>

    @if (session()->has('error'))
        <div class="position-fixed top-0 end-0 m-3 alert alert-danger alert-dismissible fade show shadow-lg rounded"
            role="alert" style="min-width: 220px; max-width: 350px; z-index: 1050; padding-right: 2.5rem;"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 400000)">
            {{ session('error') }}
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                data-bs-dismiss="alert" aria-label="Close" style="width: 0.4rem; height: 0.4rem;"></button>
        </div>
    @endif

</div>
