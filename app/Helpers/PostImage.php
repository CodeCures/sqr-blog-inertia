<?php 

namespace App\Helpers;

class PostImage
{    
    /**
     * images of images
     *
     * @var array
     */
    private $images;
    
    /**
     * width of image
     *
     * @var int
     */
    private $width;
    
    
    /**
     * __construct
     *
     * @param  mixed $width
     * @return void
     */
    public function __construct($width = null)
    {
        $this->images = config('images');
    }
    
    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->shuffleImage()[0];
    }
    
    /**
     * shuffleImage
     *
     * @return array
     */
    public function shuffleImage()
    {
        shuffle($this->images);
        
        return $this->images;
    }
}
