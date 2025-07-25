@php
    // 全ての名前付きslotを動的に収集
    $collectedSlots = [];
    
    // 現在の変数スコープから全ての変数を取得
    $allVars = get_defined_vars();
    
    // 既知のシステム変数とオブジェクト変数を除外
    $systemVars = ['__env', '__data', 'errors', 'component', 'attributes', '__path', '__slots', 'app'];
    
    // 各変数をチェックしてslotかどうか判定
    foreach ($allVars as $varName => $varValue) {
        // システム変数やプライベート変数は除外
        if (!in_array($varName, $systemVars) && !str_starts_with($varName, '__')) {
            // 特殊な変数も除外
            if (!in_array($varName, ['slot', 'attributes', 'component', 'allVars', 'systemVars', 'collectedSlots', 'finalProps'])) {
                // オブジェクトや配列は除外して、文字列変換可能なもののみ処理
                if (is_string($varValue) || is_numeric($varValue) || (is_object($varValue) && method_exists($varValue, '__toString'))) {
                    try {
                        $collectedSlots[$varName] = (string) $varValue;
                    } catch (Exception $e) {
                        // 文字列変換に失敗した場合はスキップ
                        continue;
                    }
                }
            }
        }
    }
    
    // デフォルトslotも追加
    if (isset($slot)) {
        $collectedSlots['default'] = (string) $slot;
    }
    
    // attributesからpropsを構築（component以外のすべて）
    $finalProps = [];
    if (isset($attributes)) {
        foreach ($attributes->getAttributes() as $key => $value) {
            if ($key !== 'component') {
                $finalProps[$key] = $value;
            }
        }
    }
    
    // slotsを追加
    $finalProps['slots'] = $collectedSlots;
@endphp

<div>
    <!-- 子のLivewireコンポーネントをレンダリング -->
    @livewire($component, $finalProps)
</div>