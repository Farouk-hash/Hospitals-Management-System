<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('dashboard/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('dashboard/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('dashboard/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('dashboard/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('dashboard/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('dashboard/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('dashboard/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('dashboard/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('dashboard/plugins/side-menu/sidemenu.js')}}"></script>



<!-- Internal Data tables -->
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('dashboard/js/table-data.js')}}"></script>



{{-- Pusher Notifications --}}
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
    // Counter initialized from backend
    let count = parseInt(document.getElementById('notificationCount').textContent.trim(), 10) || 0;
    
    // DOM selectors
    const counterText = document.querySelector('.notification-pusher .dropdown-title-text');
    const notificationList = document.querySelector('.notification-pusher .main-notification-list');
    const notificationBell = document.getElementById('notificationBell');
    
    // Add pulse
    function addPulse() {
        if (notificationBell && !notificationBell.querySelector('.pulse')) {
            const pulse = document.createElement('span');
            pulse.classList.add('pulse');
            notificationBell.appendChild(pulse);
        }
    }
    
    // Remove pulse
    function removePulse() {
        if (notificationBell) {
            const pulse = notificationBell.querySelector('.pulse');
            if (pulse) pulse.remove();
        }
    }
    
    // Listen for click to remove pulse
    if (notificationBell) {
        notificationBell.addEventListener('click', removePulse);
    }
    
    // Initialize Pusher
    const pusher = new Pusher('cea3670c997c956c9f9c', {
        cluster: 'mt1',
        forceTLS: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                // 'Content-Type': 'application/json',
            }
        }
    });
    
    const userId = {{ auth()->id() ?? 'null' }};
    console.log('User ID:', userId);
    
    // Subscribe to private channel
    const channelName = `private-single-invoice-${userId}`;
    console.log('Subscribing to channel:', channelName);
    
    const channel = pusher.subscribe(channelName);
    
    // Handle subscription events
    channel.bind('pusher:subscription_succeeded', function() {
        console.log('Successfully subscribed to private channel');
    });
    
    channel.bind('pusher:subscription_error', function(error) {
        console.error('Subscription error:', error);
    });
    
    // Listen for your custom event
    channel.bind('single-invoice-event', function(data) {
        console.log('Private channel event received:', data);
        
        // Pulse effect
        addPulse();
        
        // Update counter
        count++;
        if (counterText) {
            counterText.innerText = `You have ${count} Notifications`;
        }
        
        // Create notification item
        if (notificationList) {
            const item = document.createElement('a');
            const patientBaseUrl = "{{ url(app()->getLocale() . '/patient/show') }}/";
            item.href = patientBaseUrl + data.patient_id;
            item.classList.add('d-flex', 'p-3', 'border-bottom');
            
            // Left section
            const leftDiv = document.createElement('div');
            leftDiv.classList.add('mr-3');
            
            const title = document.createElement('h5');
            title.classList.add('notification-label', 'mb-1');
            title.innerText = data.username || 'New Notification';
            
            const message = document.createElement('div');
            message.classList.add('notification-message');
            message.innerText = data.message || 'You have a new alert.';
            
            const subtext = document.createElement('div');
            subtext.classList.add('notification-subtext');
            subtext.innerText = data.time || 'Just now';
            
            leftDiv.appendChild(title);
            leftDiv.appendChild(message);
            leftDiv.appendChild(subtext);
            item.appendChild(leftDiv);
            
            // Insert before VIEW ALL if exists
            let viewAll = notificationList.querySelector('.dropdown-footer');
            if (viewAll) {
                notificationList.insertBefore(item, viewAll);
            } else {
                notificationList.appendChild(item);
            }
            
            // Add VIEW ALL if missing
            if (!viewAll) {
                const viewDiv = document.createElement('div');
                viewDiv.classList.add('text-center', 'dropdown-footer');
                
                const viewLink = document.createElement('a');
                viewLink.href = "#";
                viewLink.innerText = "VIEW ALL";
                
                viewDiv.appendChild(viewLink);
                notificationList.appendChild(viewDiv);
            }
        }
    });
    
    // Debug Pusher connection
    pusher.connection.bind('connected', function() {
        console.log('Pusher connected');
    });
    
    pusher.connection.bind('error', function(error) {
        console.error('Pusher connection error:', error);
    });
</script>


@livewireScripts
