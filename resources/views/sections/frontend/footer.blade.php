<footer>
    <div class="DFooterTop">
        <div class="row">
            <div class="col-sm-4">
                @if ($settings->editor_publisher)
                    <p>সম্পাদক ও প্রকাশক: {{ $settings->editor_publisher }}</p>
                @endif
                @if ($settings->chief_editor)
                    <p>প্রধান সম্পাদক: {{ $settings->chief_editor }}</p>
                @endif
            </div>
            <div class="col-sm-4">
                @if ($settings->address)
                    <div style="display: flex">
                        <p>ঠিকানা:</p>
                        &nbsp;
                        <p>{{ $settings->address }}</p>
                    </div>
                @endif
            </div>
            <div class="col-sm-4">
                @if ($settings->phone)
                    <p>ফোন: {{ $settings->phone }}</p>
                @endif
                @if ($settings->fax)
                    <p>ফ্যাক্স: {{ $settings->fax }}</p>
                @endif
                @if ($settings->email)
                    <p>ই-মেইল : <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></p>
                @endif
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
