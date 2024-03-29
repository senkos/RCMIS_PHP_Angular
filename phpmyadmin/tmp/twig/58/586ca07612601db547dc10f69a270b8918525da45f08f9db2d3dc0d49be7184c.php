<?php

/* database/central_columns/add_column.twig */
class __TwigTemplate_a8db104dfc1bad58d83b896e5fae06eda44f96d8695debcbaacdecc33fddc9de extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<table class=\"central_columns_add_column\" class=\"navigation nospacing nopadding\">
    <tr>
        <td class=\"navigation_separator largescreenonly\"></td>
        <td class=\"central_columns_navigation\">
            ";
        // line 5
        echo ($context["icon"] ?? null);
        echo "
            <form id=\"add_column\" action=\"db_central_columns.php\" method=\"post\">
                ";
        // line 7
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
                <input type=\"hidden\" name=\"add_column\" value=\"add\">
                <input type=\"hidden\" name=\"pos\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["pos"] ?? null), "html", null, true);
        echo "\" />
                <input type=\"hidden\" name=\"total_rows\" value=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["total_rows"] ?? null), "html", null, true);
        echo "\"/>
                ";
        // line 11
        echo ($context["table_drop_down"] ?? null);
        echo "
                <select name=\"column-select\" id=\"column-select\">
                    <option value=\"\" selected=\"selected\">";
        // line 13
        echo _gettext("Select a column.");
        echo "</option>
                </select>
            </form>
        </td>
        <td class=\"navigation_separator largescreenonly\"></td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "database/central_columns/add_column.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 13,  43 => 11,  39 => 10,  35 => 9,  30 => 7,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/central_columns/add_column.twig", "C:\\Server\\data\\htdocs\\phpmyadmin\\templates\\database\\central_columns\\add_column.twig");
    }
}
