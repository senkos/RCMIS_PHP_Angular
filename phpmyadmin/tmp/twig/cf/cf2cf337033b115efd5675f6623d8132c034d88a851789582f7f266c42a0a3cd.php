<?php

/* database/central_columns/table_navigation.twig */
class __TwigTemplate_d8fd4e64d4f16a442961085450a3d8f2af75a55c46fd799bf03f1bfd584a05d2 extends Twig_Template
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
        echo "<table style=\"display:inline-block;max-width:49%\" class=\"navigation nospacing nopadding\">
    <tr>
        <td class=\"navigation_separator\"></td>
        ";
        // line 4
        if (((($context["pos"] ?? null) - ($context["max_rows"] ?? null)) >= 0)) {
            // line 5
            echo "            <td>
                <form action=\"db_central_columns.php\" method=\"post\">
                    ";
            // line 7
            echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
            echo "
                    <input type=\"hidden\" name=\"pos\" value=\"";
            // line 8
            echo twig_escape_filter($this->env, (($context["pos"] ?? null) - ($context["max_rows"] ?? null)), "html", null, true);
            echo "\" />
                    <input type=\"hidden\" name=\"total_rows\" value=\"";
            // line 9
            echo twig_escape_filter($this->env, ($context["total_rows"] ?? null), "html", null, true);
            echo "\"/>
                    <input type=\"submit\" name=\"navig\" class=\"ajax\" value=\"&lt\" />
                </form>
            </td>
        ";
        }
        // line 14
        echo "        ";
        if ((($context["nb_total_page"] ?? null) > 1)) {
            // line 15
            echo "            <td>
                <form action=\"db_central_columns.php\" method=\"post\">
                    ";
            // line 17
            echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
            echo "
                    <input type=\"hidden\" name=\"total_rows\" value=\"";
            // line 18
            echo twig_escape_filter($this->env, ($context["total_rows"] ?? null), "html", null, true);
            echo "\"/>
                    ";
            // line 19
            echo ($context["page_selector"] ?? null);
            echo "
                </form>
            </td>
        ";
        }
        // line 23
        echo "        ";
        if (((($context["pos"] ?? null) + ($context["max_rows"] ?? null)) < ($context["total_rows"] ?? null))) {
            // line 24
            echo "            <td>
                <form action=\"db_central_columns.php\" method=\"post\">
                    ";
            // line 26
            echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
            echo "
                    <input type=\"hidden\" name=\"pos\" value=\"";
            // line 27
            echo twig_escape_filter($this->env, (($context["pos"] ?? null) + ($context["max_rows"] ?? null)), "html", null, true);
            echo "\"/>
                    <input type=\"hidden\" name=\"total_rows\" value=\"";
            // line 28
            echo twig_escape_filter($this->env, ($context["total_rows"] ?? null), "html", null, true);
            echo "\"/>
                    <input type=\"submit\" name=\"navig\" class=\"ajax\" value=\"&gt\" />
                </form>
            </td>
        ";
        }
        // line 33
        echo "        </form>
        </td>
        <td class=\"navigation_separator\"></td>
        <td>
            <span>";
        // line 37
        echo _gettext("Filter rows");
        echo ":</span>
            <input type=\"text\" class=\"filter_rows\" placeholder=\"";
        // line 38
        echo _gettext("Search this table");
        echo "\">
        </td>
        <td class=\"navigation_separator\"></td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "database/central_columns/table_navigation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 38,  97 => 37,  91 => 33,  83 => 28,  79 => 27,  75 => 26,  71 => 24,  68 => 23,  61 => 19,  57 => 18,  53 => 17,  49 => 15,  46 => 14,  38 => 9,  34 => 8,  30 => 7,  26 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/central_columns/table_navigation.twig", "C:\\Server\\data\\htdocs\\phpmyadmin\\templates\\database\\central_columns\\table_navigation.twig");
    }
}
