<div class="content">
    <h2>"<?php echo rtrim($quote->quote); ?>"</h2>
    <p class="votes">
        <a href="" class="fa fa-thumbs-up upvote" title="Vote for this quote!" data-id="<?php echo $quote->ID; ?>">
            <span class="upvotes" id="upvote-<?php echo $quote->ID; ?>"><?php echo $quote->upvotes; ?></span>
        </a>
        <a href="" class="fa fa-thumbs-down downvote" title="This quote sucks, downvote!" data-id="<?php echo $quote->ID; ?>">
            <span class="downvotes" id="downvote-<?php echo $quote->ID; ?>"><?php echo $quote->downvotes; ?></span>
        </a>
    </p>
    <p class="permalink"><a href="<?php echo URL; ?>quote/permalink/<?php echo $quote->ID; ?>" title="Link to this quote">(permalink)</a></p>
</div>
