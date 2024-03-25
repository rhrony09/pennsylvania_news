<footer>
    <div class="DFooterTop">
        <div class="row">
            <div class="col-sm-4">
                @if ($settings->editor_publisher)
                    <p><strong>সম্পাদক ও প্রকাশক:</strong> {{ $settings->editor_publisher }}</p>
                @endif
                @if ($settings->chief_editor)
                    <p><strong>প্রধান সম্পাদক:</strong> {{ $settings->chief_editor }}</p>
                @endif
                <div class="footer-logo hidden-xs">
                    <img src="{{ asset('uploads/logos/' . $settings->logo_light) . '?v=' . now()->timestamp }}">
                    <img src="{{ asset('uploads/logos/pbn-tv.svg') }}">
                </div>
            </div>
            <div class="col-sm-4">
                @if ($settings->address)
                    <div style="display: flex">
                        <p><strong>ঠিকানা:</strong></p>
                        &nbsp;
                        <p><a href="{{ $settings->map_link }}" target="_blank">{{ $settings->address }}</a></p>
                    </div>
                @endif
            </div>
            <div class="col-sm-4">
                @if ($settings->phone)
                    <p><strong>ফোন:</strong> <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a></p>
                @endif
                @if ($settings->fax)
                    <p><strong>ফ্যাক্স:</strong> {{ $settings->fax }}</p>
                @endif
                @if ($settings->email)
                    <p><strong>ই-মেইল:</strong> <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></p>
                @endif
                <div class="footer-logo visible-xs-block mt-md-20 mb-md-10">
                    <img src="{{ asset('uploads/logos/' . $settings->logo_light) . '?v=' . now()->timestamp }}">
                    <img src="{{ asset('uploads/logos/pbn-tv.svg') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="DFooterBottom">
        <div class="row">
            <div class="col-sm-12">
                <p><a href="{{ route('index') }}">{{ $settings->site_name }}</a> <span class="En">&copy;</span> {{ bangla_date(time(), 'en', 'y') }} | সর্বসত্ব সংরক্ষিত</p>
            </div>
        </div>
    </div>
</footer>
