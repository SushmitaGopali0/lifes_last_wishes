<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#user-management" aria-expanded="false" aria-controls="user-management">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user-management" data-bs-parent="#sidebar">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#content-management" aria-expanded="false" aria-controls="content-management">
          <i class="mdi mdi-content-save menu-icon"></i>
          <span class="menu-title">Content</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="content-management" data-bs-parent="#sidebar">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.post.index') }}">Posts</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.post-category.index') }}">Post Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.page.index') }}">Pages</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.page-category.index') }}">Page Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.page-setting.index') }}">Page Settings</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-folder-image menu-icon"></i>
          <span class="menu-title">Media</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#subscription" aria-expanded="false" aria-controls="subscription">
          <i class="mdi mdi-bell menu-icon"></i>
          <span class="menu-title">Subscriptions</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="subscription" data-bs-parent="#sidebar">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.coupon.index') }}">Coupons</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.plan.index') }}">Plans</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.member.index') }}">Members</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.payment-history.index') }}">Payment History</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.subscription-setting.index') }}">Settings</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#newsletter" aria-expanded="false" aria-controls="newsletter">
          <i class="mdi mdi-email menu-icon"></i>
          <span class="menu-title">Newsletter</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="newsletter" data-bs-parent="#sidebar">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.newsletter.index') }}"> Subscribers </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.newsletter-setting.index') }}"> Settings </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#testimonial" aria-expanded="false" aria-controls="testimonial">
          <i class="mdi mdi-comment-text menu-icon"></i>
          <span class="menu-title">Testimonials</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="testimonial" data-bs-parent="#sidebar">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.testimonial.index') }}">Records</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.testimonial-setting.index') }}">Settings</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-message menu-icon"></i>
          <span class="menu-title">Contact Message</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-book-open-page-variant menu-icon"></i>
          <span class="menu-title">Manifestos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#questionaries" aria-expanded="false" aria-controls="questionaries">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Questionaries</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="questionaries" data-bs-parent="#sidebar">
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
