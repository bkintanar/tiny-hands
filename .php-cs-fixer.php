<?php

$rules = [
    '@PSR12' => true,
    'ordered_imports' => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'length'],
    'single_trait_insert_per_statement' => false,
    'array_syntax' => ['syntax' => 'short'],
    'multiline_whitespace_before_semicolons' => false,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'no_useless_else' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_package' => true,
    'phpdoc_order' => true,
    // The upgraded CSFixer changes too many files with this setting on.
    // Disabled temporarily to help with the code-review of KGSP-3667.
//    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_trim' => true,
    'phpdoc_var_without_name' => true,
    'phpdoc_to_comment' => true,
    'single_quote' => true,
    'trailing_comma_in_multiline' => [
        'elements' => [
            'arrays',
        ],
    ],
    'trim_array_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    'method_chaining_indentation' => true,
    'php_unit_test_annotation' => true,
    'php_unit_method_casing' => ['case' => 'snake_case'],
    'no_empty_phpdoc' => true,
    'class_attributes_separation' => ['elements' => ['method' => 'one']],
];

return (new \PhpCsFixer\Config())
    ->setRules($rules)
    ->setRiskyAllowed(true) // php_unit_test_annotation needs this.
    ->setFinder(
        \PhpCsFixer\Finder::create()
            ->in([
                __DIR__ . '/app',
                __DIR__ . '/database',
                __DIR__ . '/routes',
                __DIR__ . '/tests',
            ])
    );
