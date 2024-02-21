<footer>
    <div class="DFooterTop">
        <div class="row">
            <div class="col-sm-4">
                <p>সম্পাদক ও প্রকাশক: {{ $settings->editor_publisher }}</p>
                <p>প্রধান সম্পাদক: {{ $settings->chief_editor }}</p>

            </div>
            <div class="col-sm-4">
                <p>ঠিকানা: {{ $settings->address }}</p>

            </div>
            <div class="col-sm-4">
                <p>ফোন: {{ $settings->phone }}</p>
                <p>ফ্যাক্স: {{ $settings->fax }}</p>
                <p>ই-মেইল : <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></p>
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
