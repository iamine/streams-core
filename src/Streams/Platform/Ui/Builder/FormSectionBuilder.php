<?php namespace Streams\Platform\Ui\Builder;

use Streams\Platform\Ui\FormUi;

class FormSectionBuilder extends FormBuilderAbstract
{
    /**
     * Return the data.
     *
     * @return array
     */
    public function data()
    {
        $title  = $this->buildTitle();
        $fields = $this->buildFields();

        return compact('title', 'fields');
    }

    /**
     * Return the title.
     *
     * @return string
     */
    protected function buildTitle()
    {
        return trans(evaluate_key($this->options, 'title', null, [$this->ui]));
    }

    /**
     * Build the fields.
     *
     * @return array
     */
    protected function buildFields()
    {
        $fields = [];

        $assignments = $this->ui->getEntry()->getStream()->assignments;

        foreach (evaluate_key($this->options, 'fields', []) as $field) {
            if (!in_array($field, $this->ui->getSkips())) {
                $fields[$field] = $assignments->findByFieldSlug($field);
            }
        }

        return $fields;
    }
}
