<?php
namespace TypiCMS\Modules\Files\Models;

use Croppa;
use Dimsav\Translatable\Translatable;
use TypiCMS\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Presenters\PresentableTrait;

class File extends Base
{

    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Files\Presenters\ModulePresenter';

    protected $fillable = array(
        'gallery_id',
        'type',
        'name',
        'file',
        'path',
        'extension',
        'mimetype',
        'width',
        'height',
        'filesize',
        'position',
        // Translatable columns
        'description',
        'alt_attribute',
    );

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = array(
        'description',
        'alt_attribute',
    );

    protected $appends = ['alt_attribute', 'description', 'thumb_src', 'thumb_sm'];

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = array(
        'file',
    );

    /**
     * One file belongs to one gallery.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function gallery()
    {
        return $this->belongsTo('TypiCMS\Modules\Galleries\Models\Gallery');
    }

    /**
     * Get translated title
     */
    public function getTitleAttribute($value)
    {
        return $value;
    }

    /**
     * Get translated alt attribute
     * @return string alt attribute
     */
    public function getAltAttributeAttribute()
    {
        return $this->alt_attribute;
    }

    /**
     * Get thumb attribute from presenter
     * @return string src
     */
    public function getThumbSrcAttribute($value)
    {
        return $this->present()->thumbSrc(null, 22, [], 'file');
    }

    /**
     * Get thumb attribute from presenter
     * @return string src
     */
    public function getThumbSmAttribute($value)
    {
        return $this->present()->thumbSrc(130, 130, [], 'file');
    }

    /**
     * Get translated description
     * @return string description
     */
    public function getDescriptionAttribute()
    {
        return $this->description;
    }
}
