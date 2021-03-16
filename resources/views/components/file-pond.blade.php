<div>
    <x-laravel-blade-ui::form.group :label="$lable">
        <input type="file"
               id="file_gallery"
               class="filepond"
               name="files[gallery][]"
               @if(isset($relation) && $relation->attachments()->exists())
                data-files="{{json_encode($relation->attachments->toArray())}}"
               @endif
               multiple
               :data-label-idle='$embededMessage'
               data-allow-reorder="true"
               data-max-file-size="{{ $maxMBFileSize }}MB"
               preview-image
               data-relation="{{ get_class($relation) }}"
               data-relation-id="{{ $relation->getKey() }}"
               data-folder="{{ (new \ReflectionClass(get_class($relation)))->getShortName() }}">
    </x-laravel-blade-ui::form.group>
</div>
