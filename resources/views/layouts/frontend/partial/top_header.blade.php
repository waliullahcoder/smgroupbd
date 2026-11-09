 <div class="topbar">
     <div class="wrap topbar-in">
         <div class="tb-l"><span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
                     style="color:#8FD07F">
                     <path
                         d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z">
                     </path>
                 </svg><span>Talk to an expert:</span> <a class="b" href="tel:+88{{$setting->primary_mobile}}">+88{{$setting->primary_mobile}}</a></span>
             <span class="tb-mail"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
                     style="color:#8FD07F">
                     <path d="M3 5h18v14H3zM3 6l9 7 9-7"></path>
                 </svg><a href="mailto:{{$setting->primary_email}}">{{$setting->primary_email}}</a></span>
         </div>
         <div class="tb-r"><a href="{{$admin_setting->whatsapp}}" target="_blank">WhatsApp</a><a href="{{$admin_setting->linkedin ?? $setting->linkedin}}" target="_blank">LinkedIn</a><a href="{{$setting->facebook}}" target="_blank">Facebook</a><a href="{{$setting->youtube}}" target="_blank">YouTube</a><a href="{{url('/login')}}">Admin</a></div>
     </div>
 </div>