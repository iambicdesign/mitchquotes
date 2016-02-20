<?php
/**
 * Class Quote
 */

class Quote extends Controller
{
    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        parent::__construct();
        $this->loadModel('quotemodel');
    }

    public function permalink($id)
    {
        $quote = $this->quotemodel->getByID($id);
        require APP . 'view/_templates/header.php';
        require APP . 'view/quote/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function top()
    {
        $quotes = $this->quotemodel->getTop(10);
        $this->title = 'Top Voted Mitch Hedberg Quotes';
        require APP . 'view/_templates/header.php';
        require APP . 'view/quote/list.php';
        require APP . 'view/_templates/footer.php';
    }

    public function bottom()
    {
        $quotes = $this->quotemodel->getBottom(10);
        $this->title = 'Most Down-voted Mitch Quotes';
        require APP . 'view/_templates/header.php';
        require APP . 'view/quote/list.php';
        require APP . 'view/_templates/footer.php';
    }

    public function latest()
    {
        $quotes = $this->quotemodel->getLatest(10);
        $this->title = 'Recently Added Quotes';
        require APP . 'view/_templates/header.php';
        require APP . 'view/quote/list.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // For the sake of dupe content with the homepage, just 301 them there
        header("location: " . URL, true, 301);
        exit();
    }
}