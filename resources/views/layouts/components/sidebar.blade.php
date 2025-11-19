            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="{{ Request::is('/') ? 'active' : ''}}"> 
								<a href="{{ url('/') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ Request::is('borrow') ? 'active' : ''}}"> 
								<a href="{{ route('borrow.index') }}"><i class="fe fe-cart"></i> <span>Borrowing</span></a>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);"><i class="fe fe-users"></i> <span> Students</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('student') ? 'active' : ''}}" href="{{ route('student.index') }}">All Students</a></li>
									<li><a class="{{ Request::is('student/create') ? 'active' : ''}}" href="{{ route('student.create') }}">Add New Student</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);"><i class="fe fe-book"></i> <span> Books</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('book') ? 'active' : ''}}" href="{{ route('book.index') }}">All Books</a></li>
									<li><a class="{{ Request::is('book/create') ? 'active' : ''}}" href="{{ route('book.create') }}">Add New Book</a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->