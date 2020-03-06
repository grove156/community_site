
<nav class="navbar navbar-default navbar-static-top">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ auth()->check() ? route('home') : route('root') }}">
        {{ config('app.name', 'Any Community Site') }}
      </a>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a class="nav-item nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
            <li><a class="nav-item nav-link" href="#">Article</a></li>
            <li><a class="nav-item nav-link" href="#">Talking</a></li>
          </ul>
        <div class="align-items-right">
          <ul class="nav navbar-nav navbar-right align-items-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
              <li>
                <a href="{{ route('sessions.create', ['return' => urlencode($currentUrl)]) }}">
                  {{ trans('auth.sessions.title') }}
                </a>
              </li>
              <li>
                <a href="{{ route('users.create', ['return' => urlencode($currentUrl)]) }}">
                  {{ trans('auth.users.title') }}
                </a>
              </li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="{{ route('sessions.destroy') }}">
                      {{ trans('auth.sessions.destroy') }}
                    </a>
                  </li>
                </ul>
              </li>
            @endif
          </ul>
        </div>
      </div>
</nav>
