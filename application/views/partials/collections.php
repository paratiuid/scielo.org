<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$lang_index = isset($language) ? $language : SCIELO_EN_LANG;
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <dl>
           <?php 
           // Periódicos
            $counter = 0;
            foreach ($this->Collections->get_journals_list() as $key => $journal) : 
            $has_journal_count = (ENABLED_COUNTS_DISPLAY && array_key_exists('current', $journal->journal_count));
            $has_document_count = (ENABLED_COUNTS_DISPLAY && !empty($journal->document_count));
            $flag_no_data_css = (!$has_journal_count && !$has_document_count) ? 'flag-no-data' : null;
            ?>
            <dd class="flag-<?= $journal->code ?> <?= $flag_no_data_css ?> <?php if($counter == 0):?> first-node-collection <?php endif;?>">
                <?php if($counter++ == 0):?>
                <h3><?= lang('journals_list') ?></h3>
                <?php endif;?>
                <a href="http://<?= $journal->domain ?>">
                    <h4><?= $journal->name[$lang_index] ?></h4>
                    <span><?php if ($has_journal_count) : ?><?= $journal->journal_count['current'] ?> <?= pluralize($journal->journal_count['current'], lang('journals_singular'), lang('journals')) ?> •<?php endif; ?> <?php if ($has_document_count) : ?><?= $journal->document_count ?> <?= lang('articles') ?><?php endif; ?></span>
                </a>
            </dd>
            <?php endforeach; ?>

            <?php 
           // Periódicos em desenvolvimento
            $counter = 0;
            foreach ($this->Collections->get_development_list() as $key => $journal) : 
            $has_journal_count = (ENABLED_COUNTS_DISPLAY && array_key_exists('current', $journal->journal_count));
            $has_document_count = (ENABLED_COUNTS_DISPLAY && !empty($journal->document_count));
            $flag_no_data_css = (!$has_journal_count && !$has_document_count) ? 'flag-no-data' : null;
            ?>
            <dd class="flag-<?= $journal->code ?> <?= $flag_no_data_css ?> <?php if($counter == 0):?> first-node-collection <?php endif;?>">
                <?php if($counter++ == 0):?>
                <h3><?= lang('development_list') ?></h3>
                <?php endif;?>
                <a href="http://<?= $journal->domain ?>">
                    <h4><?= $journal->name[$lang_index] ?></h4>
                    <span><?php if ($has_journal_count) : ?><?= $journal->journal_count['current'] ?> <?= pluralize($journal->journal_count['current'], lang('journals_singular'), lang('journals')) ?> •<?php endif; ?> <?php if ($has_document_count) : ?><?= $journal->document_count ?> <?= lang('articles') ?><?php endif; ?></span>
                </a>
            </dd>
            <?php endforeach; ?>
        <div>
            <?php 
            // Servidores e repositórios
            $counter = 0;
            foreach (array_merge($this->Collections->get_repositories_list(), $this->Collections->get_preprints_list()) as $key => $server_or_repo) : 
            ?>
                <dd class="scielo-servers-repos scielo-servers-repos-no-data <?php if($counter == 0):?> first-node-collection <?php endif;?>">
                    <?php if($counter++ == 0):?>
                    <h3><?= lang('servers_and_repos') ?></h3>
                    <?php endif;?>
                    <a href="https://<?= $server_or_repo->domain ?>">
                        <h4><?= $server_or_repo->name[$lang_index] ?></h4>
                    </a>
                </dd>
            <?php endforeach; ?>
        </div>
            <?php 
            // Livros
            $counter = 0;
            foreach ($this->Collections->get_books_list() as $key => $book) : 
            ?>
                <dd class="scielo-books scielo-books-no-data <?php if($counter == 0):?> first-node-collection <?php endif;?>">
                    <?php if($counter++ == 0):?>
                    <h3><?= lang('books') ?></h3>
                    <?php endif;?>
                    <a href="http://<?= $book->domain ?>">
                        <h4><?= $book->name[$lang_index] ?></h4>
                    </a>
                </dd>
            <?php endforeach; ?>

            <?php 
            // Outros
            $counter = 0;
            foreach ($this->Collections->get_others_list() as $key => $other) : 
            $has_journal_count = (ENABLED_COUNTS_DISPLAY && array_key_exists('current', $other->journal_count));
            $has_document_count = (ENABLED_COUNTS_DISPLAY && !empty($other->document_count));
            $scielo_books_no_data_css = (!$has_journal_count && !$has_document_count) ? 'scielo-books-no-data' : null;
            ?>
                <dd class="scielo-books <?= $scielo_books_no_data_css ?> <?php if($counter == 0):?> first-node-collection <?php endif;?>">
                    <?php if($counter++ == 0):?>
                    <h3><?= lang('others') ?></h3>
                    <?php endif;?>
                    <a href="http://<?= $other->domain ?>">
                        <h4><?= $other->name[$lang_index] ?></h4>
                        <span><?php if ($has_journal_count) : ?><?= $other->journal_count['current'] ?> <?= pluralize($other->journal_count['current'], lang('journals_singular'), lang('journals')) ?> •<?php endif; ?> <?php if ($has_document_count) : ?><?= $other->document_count ?> <?= lang('articles') ?><?php endif; ?></span>
                    </a>
                </dd>
            <?php endforeach; ?>

            <?php /*
            // Em desenvolvimento
            $counter = 0;
            foreach ($this->Collections->get_development_list() as $key => $development) : 
            $has_journal_count = (ENABLED_COUNTS_DISPLAY && array_key_exists('current', $development->journal_count));
            $has_document_count = (ENABLED_COUNTS_DISPLAY && !empty($development->document_count));
            $flag_no_data_css = (!$has_journal_count && !$has_document_count) ? 'flag-no-data' : null;
            ?>
                <dd class="flag-<?= $development->code ?> <?= $flag_no_data_css ?> <?php if($counter == 0):?> first-node-collection <?php endif;?>">
                    <?php if($counter++ == 0):?>
                    <h3><?= lang('development_list') ?></h3>
                    <?php endif;?>
                    <a href="http://<?= $development->domain ?>">
                        <h4><?= $development->name[$lang_index] ?></h4>
                        <span><?php if ($has_journal_count) : ?><?= $development->journal_count['current'] ?> <?= pluralize($development->journal_count['current'], lang('journals_singular'), lang('journals')) ?> •<?php endif; ?> <?php if ($has_document_count) : ?><?= $development->document_count ?> <?= lang('articles') ?><?php endif; ?></span>
                    </a>
                </dd>
            <?php endforeach; */ ?>
        </dl>
    </div>
</div>
