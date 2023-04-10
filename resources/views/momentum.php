<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Momentum</title>

    <!-- Styles -->
    <link href="https://unpkg.com/filepond@4.30.4/dist/filepond.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/css">
        h1 a:before, 
        h2 a:before {
            content: "# ";
            color: #eb4432;
            margin-left: -1em;
        }
        a.link{
            color: #eb4432;
            text-decoration: underline;
        }
        :not(pre)>code {
            display: inline-flex;
            padding: 0 0.125rem;
            border-radius: 0.25rem;
            max-width: 100%;
            overflow-x: auto;
            vertical-align: middle;
            background-color: rgb(241, 245, 249);
        }
    </style>
</head>
<body>
    <div class="flex items-start">
        <aside class="bg-gradient-to-b from-gray-100 to-white flex flex-col justify-end items-end 2xl:max-w-lg 2xl:w-full">
            <div class=" xl:w-80">
                <a href="/" class="flex py-14 px-8 xl:px-16">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="128px" height="40px" viewBox="0 0 64 20" enable-background="new 0 0 64 20" xml:space="preserve">
                        <g>
                            <path fill="#010101" d="M6.006,10.196l6.243,3.46c0.313,0.176,0.521,0.334,0.625,0.471c0.104,0.139,0.155,0.314,0.155,0.527
                                c0,0.27-0.098,0.502-0.292,0.699c-0.194,0.197-0.42,0.297-0.677,0.297c-0.169,0-0.423-0.094-0.762-0.281L2,10.196l9.299-5.171
                                c0.339-0.182,0.589-0.272,0.753-0.272c0.263,0,0.491,0.097,0.686,0.291c0.195,0.194,0.292,0.427,0.292,0.696
                                c0,0.213-0.052,0.389-0.155,0.526c-0.103,0.137-0.312,0.295-0.625,0.47L6.006,10.196z"/>
                            <path fill="#010101" d="M22.748,3.747L16.57,17.063c-0.156,0.332-0.298,0.547-0.423,0.646c-0.163,0.133-0.36,0.197-0.592,0.197
                                c-0.264,0-0.491-0.094-0.683-0.281c-0.19-0.188-0.286-0.4-0.286-0.639c0-0.17,0.075-0.418,0.226-0.744l6.196-13.305
                                c0.156-0.332,0.294-0.548,0.413-0.648c0.17-0.132,0.367-0.197,0.593-0.197c0.264,0,0.489,0.093,0.677,0.277
                                c0.188,0.185,0.282,0.396,0.282,0.635C22.974,3.173,22.898,3.421,22.748,3.747z"/>
                            <path fill="#010101" d="M41.002,16.676c-0.075-0.252-0.128-0.41-0.159-0.479L34.654,2.938c-0.063-0.137-0.225-0.415-0.247-0.446
                                c-0.068-0.1-0.138-0.179-0.203-0.23c-0.146-0.112-0.332-0.169-0.563-0.169c-0.002,0-0.006,0.001-0.008,0.001
                                s-0.005-0.001-0.008-0.001c-0.227,0-0.423,0.065-0.592,0.197c-0.055,0.046-0.112,0.117-0.174,0.21
                                c-0.045,0.059-0.082,0.119-0.108,0.182c-0.043,0.077-0.086,0.161-0.132,0.257l-5.463,11.73l-2.545-5.452
                                c-0.146-0.306-0.287-0.515-0.423-0.621c-0.145-0.113-0.332-0.169-0.564-0.169c-0.257,0-0.48,0.094-0.672,0.282
                                c-0.191,0.188-0.287,0.4-0.287,0.639c0,0.163,0.078,0.411,0.235,0.743c0,0,3.349,7.183,3.358,7.201
                                c0.044,0.107,0.11,0.207,0.2,0.303c0.046,0.057,0.093,0.107,0.138,0.143c0.136,0.107,0.318,0.16,0.543,0.168
                                c0.009,0,0.018,0.002,0.026,0.002c0.002,0,0.004,0,0.006,0c0.003,0,0.005,0,0.008,0c0.034,0,0.066-0.006,0.1-0.008
                                c0.019-0.002,0.039-0.002,0.058-0.006c0.194-0.027,0.364-0.105,0.506-0.24c0.125-0.119,0.305-0.521,0.339-0.592l5.455-11.758
                                l5.457,11.719c0.156,0.326,0.307,0.547,0.451,0.658c0.145,0.113,0.339,0.17,0.583,0.17c0.263,0,0.483-0.084,0.662-0.254
                                s0.269-0.367,0.269-0.594C41.059,16.93,41.04,16.818,41.002,16.676z"/>
                            <path fill="#010101" d="M57.995,10.196l-6.243-3.46c-0.313-0.175-0.521-0.332-0.625-0.47c-0.104-0.138-0.154-0.313-0.154-0.526
                                c0-0.27,0.098-0.502,0.291-0.696c0.194-0.194,0.424-0.291,0.687-0.291c0.163,0,0.413,0.091,0.753,0.272L62,10.196l-9.298,5.173
                                c-0.339,0.188-0.591,0.281-0.753,0.281c-0.264,0-0.491-0.098-0.686-0.291c-0.195-0.195-0.293-0.43-0.293-0.705
                                c0-0.213,0.053-0.389,0.155-0.527c0.103-0.137,0.312-0.295,0.625-0.471L57.995,10.196z"/>
                        </g>
                    </svg>
                </a>
                <div class="overflow-x-hidden px-8 xl:px-16">
                    <nav class="block">
                        <ul>
                            <li><h2 class="text-l font-medium py-2">File Upload</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Planned Features:</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Oauth</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Subscriptions</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Recaptcha</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Icons</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Default Emails</h2></li>
                            <li><h2 class="text-l py-2 text-slate-300">Default Notifications</h2></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>
        <section class="flex-1">
            <div class="max-w-screen-lg sm:px-16 px-24">
                <section class="mt-8 md:mt-16">
                    <section class="max-w-prose">
                        <div id="main-content">
                            <h1 id="filepond" class="text-2xl">
                                <a href="#filepond">File upload</a>
                            </h1>
                            <p>This is an implementation of <a class="link" href="https://pqina.nl/filepond/docs/" target="_blank">Filepond</a>, which helps with uploading files before the user submits a form.
                            Momentum simplified the installation process and added some basic functionality.</p>
                            <br/>
                            <p>Here is a preview of the feature:</p>
                            <br/>
                            <form enctype="multipart/form-data">
                                <div>
                                    <x-input-label for="filepond" :value="__('Profile Image')" />
                                    <input type="file" name="filepond" id="filepond" credits="false" />
                                </div>
                            </form><br/>

                            <h1 class="text-2xl" id="installation">
                                <a href="#installation">Installation</a>
                            </h1>
                            <p>All uploads on a page can be converted into filepond uploads using one command, the only requirement is that your view has a form with an upload field like:</p>
                            <pre class="bg-slate-800 text-slate-50 rounded-lg p-8 my-8"><code><span class="">&lt;form&gt;<br/>    &lt;input type="file"&gt;<br/>&lt;/form&gt;</span></code></pre>
                            <p>To install filepond on a specific view, use:</p>
                            <pre class="bg-slate-800 text-slate-50 rounded-lg p-8 my-8"><code><span class="">php artisan momentum:insert-upload {page}</span></code></pre>

                            <p>Where <code>{page}</code> is the path to the view relative to the <code>/resources/views/</code> folder.</p><br/>

                            <p>For example:</p>
                            <pre class="bg-slate-800 text-slate-50 rounded-lg p-8 my-8"><code><span class="">php artisan momentum:insert-upload profile/edit</span></code></pre>
                            
                            
                            <blockquote>
                                <div class="max-w-2xl mx-auto px-4 py-8 shadow-lg flex items-center">
                                    <div class="w-20 h-20 flex items-center justify-center shrink-0 bg-purple-600 mb-0">
                                        <svg></svg>
                                    </div><p class="ml-6">Views need to be in the <code>resources/view/</code> directory, no path traversal (e.g. '/../') is allowed.</p>
                                </div>
                            </blockquote><br/>

                            <p>The <a href="#scheduler" class="link">scheduler</a> needs to be activated by the following command:</p>
                            <pre class="bg-slate-800 text-slate-100 rounded-lg p-8 my-8"><code class=""><span class="">php artisan schedule:work</span></code></pre>

                            <h2 class="text-xl" id="storage">
                                <a href="#storage">Storage</a>
                            </h2>
                            <p>The file will be uploaded to <code>\momentum\uploads\tmp</code>. It will use the <code>PUBLIC_DISK_NAME</code> value in the .env file as the base of the file path. If <code>PUBLIC_DISK_NAME</code> is not set upon installation, it will default to <code>'public'</code>.</p><br/>

                            <p>When the user submits the upload, the file will be removed from the <code>\momentum\uploads\tmp</code> folder, and be transferred to <code>\momentum\uploads</code> directly.</p><br/>

                            <p>Each file gets a folder with a unique name. If you wish to remember the filename, you'll have to store it in the database. This is because filenames are often unnecessary and can contain malicious content.</p><br/>

                            <h2 class="text-xl" id="scheduler">
                                <a href="#scheduler">Scheduler</a>
                            </h2>
                            <p>Every hour, a job launches called <code>momentum:clear-files</code>. Files that have been uploaded over an hour ago, but have not been submitted by the user, will be deleted. This is to prevent your application to store unnecessary files.
                            </p><br/>
                        </div>
                    </section>
                </section>
            </div>
        </section>
    </div>

    <footer class="relative pt-12">
    </footer>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        const inputElement = document.querySelector('input[type="file"]');

        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                process: '/upload/fp-upload',
                revert: '/upload/fp-delete',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    </script>
</body>
</html>