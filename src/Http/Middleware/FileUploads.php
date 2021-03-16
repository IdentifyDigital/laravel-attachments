<?php


namespace IdentifyDigital\LaravelAttachments\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FileUploads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->files->all() as $file) {
            $size = $file->getClientSize();

            $max_size = config('attachments.max_file_size', 1048576);

            if ($size > $max_size) {
                abort(Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
        return $next($request);
    }
}

