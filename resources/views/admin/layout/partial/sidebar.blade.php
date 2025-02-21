<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
          </ul>
        </div>
      </li>



      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-content-copy menu-icon"></i>
          <span class="menu-title">Content</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.post.index') }}">Posts</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.post-category.index') }}">Post Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.page.index') }}">Pages</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.page-category.index') }}">Page Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Page Settings</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-email menu-icon"></i>
          <span class="menu-title">Newsletter</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.newsletter.index') }}"> Subscribers </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Settings </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-comment-text menu-icon"></i>
          <span class="menu-title">Testimonials</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.testimonial.index') }}">Records</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Settings</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Questionaries</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('formgroups.index') }}">Form Groups</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('formgroups.index') }}">Sections</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.setting.index') }}">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">Settings</span>
        </a>
      </li>
    </ul>
  </nav>
