<pre style="margin:0;" class="h-full w-full bg-gray-300 rounded-lg overflow-hidden"><code class="language-html">



{!! isset($blade)  ? e(file_get_contents(resource_path('views/home/_form.blade.php'))) : e(view('home._form')->render()) !!}</code>

</pre>
