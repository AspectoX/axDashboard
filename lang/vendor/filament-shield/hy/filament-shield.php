<?php

return [
    /*
    |------------------------------------------------- -------------------------
    | Table Columns
    |------------------------------------------------- -------------------------
    */

    'column.name' => 'Անվանում',
    'column.guard_name' => 'Գուարդի անվանում',
    'column.roles' => 'Դերեր',
    'column.permissions' => 'Թույլտվություններ',
    'column.updated_at' => 'Թարմացվել է',

    /*
    |------------------------------------------------- -------------------------
    | Form Fields
    |------------------------------------------------- -------------------------
    */

    'field.name' => 'Անվանում',
    'field.guard_name' => 'Գուարդի անվանում',
    'field.permissions' => 'Թույլտվություններ',
    'field.select_all.name' => 'Ընտրել բոլորը',
    'field.select_all.message' => 'Միացնել բոլոր թույլտվությունները, որոնք <span class="text-primary font-medium">Հասանելի</span> են այս դերի համար',

    /*
    |------------------------------------------------- -------------------------
    | Navigation & Resource
    |------------------------------------------------- -------------------------
    */

    'nav.group' => 'Filament Shield',
    'nav.role.label' => 'Դերեր',
    'nav.role.icon' => 'icon-shield-check',
    'resource.label.role' => 'Դեր',
    'resource.label.roles' => 'Դերեր',

    /*
    |------------------------------------------------- -------------------------
    | Section & Tabs
    |------------------------------------------------- -------------------------
    */

    'section' => 'Սուբյեկտներ',
    'resources' => 'Ռեսուրսներ',
    'widgets' => 'Վիդջեթներ',
    'pages' => 'Էջեր',
    'custom' => 'Օգտագործողի թույլտվություններ',

    /*
    |------------------------------------------------- -------------------------
    | Messages
    |------------------------------------------------- -------------------------
    */

    'forbidden' => 'Դուք հասանելիություն չունեք',

    /*
    |------------------------------------------------- -------------------------
    | Resource Permissions' Labels
    |------------------------------------------------- -------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Դիտել',
        'view_any' => 'Դիտել ցանկացած',
        'create' => 'Ստեղծել',
        'update' => 'Թարմացնել',
        'delete' => 'Ջնջել',
        'delete_any' => 'Ջնջել ցանկացած',
        'force_delete' => 'Ստիպել ջնջել',
        'force_delete_any' => 'Ստիպել ջնջել ցանկացածը',
        'restore' => 'Վերականգնել',
        'reorder' => 'Վերադասավորել',
        'restore_any' => 'Վերադասավորել ցանկացածը',
        'replicate' => 'Կրկնօրինակել',
    ],
];
