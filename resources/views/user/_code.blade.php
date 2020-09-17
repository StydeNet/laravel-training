<pre style="margin:0;" class="h-full w-full bg-gray-300 rounded-lg overflow-hidden"><code class="language-html">

{!! isset($blade) ?
    e(file_get_contents(resource_path('views/'.str_replace('.', '/', $view).'.blade.php'))):
    e(view($view)->with($params ?? [])->render()) !!}</code>

</pre>
