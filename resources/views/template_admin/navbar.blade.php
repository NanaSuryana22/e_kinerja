<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
              <i class="bi bi-justify fs-3"></i>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <div class="user-name text-end me-3">
                      <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                      <p class="mb-0 text-sm text-gray-600">
                        {{ ucfirst(auth()->user()->role) }}
                      </p>
                    </div>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <a href="#" title="Profile">
                                        <i class="fas fa-user-circle fa-2x" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="jarak-logout-profile">
                                <a
                                    href="#"
                                    onclick="return logout(event);"
                                    title="Keluar Aplikasi ?">
                                    <i class="fas fa-power-off fa-2x" aria-hidden="true"></i>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
