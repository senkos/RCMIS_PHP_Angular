<?php

/* table/search/replace_preview.twig */
class __TwigTemplate_95d481511905f39afe8c5b56126c3f0f9ac5e0c011cde346d48a244d7248d746 extends Twig_Template
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
        echo "<form method=\"post\"
      action=\"tbl_find_replace.php\"
      name=\"previewForm\"
      id=\"previewForm\">
    ";
        // line 5
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
        echo "
    <input type=\"hidden\" name=\"replace\" value=\"true\" />
    <input type=\"hidden\" name=\"columnIndex\" value=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" name=\"findString\" value=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["find"] ?? null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" name=\"replaceWith\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["replace_with"] ?? null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" name=\"useRegex\" value=\"";
        // line 10
        echo twig_escape_filter($this->env, ($context["use_regex"] ?? null), "html", null, true);
        echo "\" />

    <fieldset id=\"fieldset_find_replace_preview\">
        <legend>";
        // line 13
        echo _gettext("Find and replace - preview");
        echo "</legend>
        <table id=\"previewTable\">
            <thead>
            <tr>
                <th>";
        // line 17
        echo _gettext("Count");
        echo "</th>
                <th>";
        // line 18
        echo _gettext("Original string");
        echo "</th>
                <th>";
        // line 19
        echo _gettext("Replaced string");
        echo "</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 23
        if (twig_test_iterable(($context["result"] ?? null))) {
            // line 24
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["result"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 25
                echo "                    <tr>
                        <td class=\"right\">";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], 2, array(), "array"), "html", null, true);
                echo "</td>";
                // line 27
                echo "                        <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], 0, array(), "array"), "html", null, true);
                echo "</td>";
                // line 28
                echo "                        <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], 1, array(), "array"), "html", null, true);
                echo "</td>";
                // line 29
                echo "                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "            ";
        }
        // line 32
        echo "            </tbody>
        </table>
    </fieldset>

    <fieldset class=\"tblFooters\">
        <input type=\"submit\" name=\"replace\" value=\"";
        // line 37
        echo _gettext("Replace");
        echo "\" />
    </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "table/search/replace_preview.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 37,  101 => 32,  98 => 31,  91 => 29,  87 => 28,  83 => 27,  80 => 26,  77 => 25,  72 => 24,  70 => 23,  63 => 19,  59 => 18,  55 => 17,  48 => 13,  42 => 10,  38 => 9,  34 => 8,  30 => 7,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "table/search/replace_preview.twig", "C:\\Server\\data\\htdocs\\phpmyadmin\\templates\\table\\search\\replace_preview.twig");
    }
}
