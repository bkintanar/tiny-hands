<?php

$rules = [
    '@PSR2' => true,
    'blank_line_after_opening_tag' => true,
    'braces' => ['allow_single_line_anonymous_class_with_empty_body' => true],
    'compact_nullable_typehint' => true,
    'declare_equal_normalize' => true,
    'lowercase_cast' => true,
    'lowercase_static_reference' => true,
    'new_with_braces' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_leading_import_slash' => true,
    'no_whitespace_in_blank_line' => true,
    'ordered_class_elements' => ['order' => ['use_trait']],
    'ordered_imports' => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'length'],
    'return_type_declaration' => true,
    'short_scalar_cast' => true,
    'single_blank_line_before_namespace' => true,
    'visibility_required' => ['elements' => ['const', 'method', 'property']],
    'array_syntax' => ['syntax' => 'short'],
    'no_multiline_whitespace_before_semicolons' => true,
    'no_short_echo_tag' => true,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'no_useless_else' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_package' => true,
    'phpdoc_order' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_trim' => true,
    'phpdoc_var_without_name' => true,
    'phpdoc_to_comment' => true,
    'single_quote' => true,
    'ternary_operator_spaces' => true,
    'trailing_comma_in_multiline_array' => true,
    'trim_array_spaces' => true,
];

$excludes = [
    'vendor',
    'storage',
    'node_modules',
    'client',
];

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->exclude($excludes)
            ->notName('README.md')
            ->notName('*.xml')
            ->notName('*.yml')
            ->notName('*.js')
            ->notName('_ide_helper.php')
    );
