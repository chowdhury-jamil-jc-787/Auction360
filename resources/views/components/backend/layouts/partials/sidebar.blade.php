<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('assets/frontend/home/images/logo.png') }}">
      </div>
      <div class="sidebar-brand-text mx-3">Auction360</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    @can('imageSlider-list')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('imageslider.list') }}">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Coursel</span>
        </a>
    </li>
    @endcan

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
        aria-controls="collapseTable">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span>
      </a>
      <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Tables</h6>
          <a class="collapse-item" href="/roles">roles</a>
          <a class="collapse-item" href="/users">users</a>
          <a class="collapse-item" href="/categories">categories</a>
          <a class="collapse-item" href="/products">products</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/settimers">
        <i class='fas fa-business-time'></i>
        <span>Set Timer</span>
      </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Examples
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
        aria-controls="collapsePage">
        <i class="fas fa-fw fa-columns"></i>
        <span>Design</span>
      </a>
      <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">HomePage Design</h6>
          <a class="collapse-item" href="#">Banner</a>
          <a class="collapse-item" href="/galleries">Gallery</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/bids">
        <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
        <span>Auction Item</span>
      </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/bid/status">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
          <span>Bidding Status (myself)</span>
        </a>
      </li>
    <hr class="sidebar-divider">
    <div class="version">Auction360</div>
  </ul>
