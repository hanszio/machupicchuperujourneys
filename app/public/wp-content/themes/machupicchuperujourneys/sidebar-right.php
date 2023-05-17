<aside class="general_sidebar asidePagina">
        <ul>
                <?php if (
                        !function_exists('dynamic_sidebar')
                        || !dynamic_sidebar('pages_widgets')
                ) : ?>
                <?php endif; ?>
        </ul>
</aside>