<?php
function h($v){ return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

function paginate($total, $per=20){
  $page = max(1, (int)($_GET['page'] ?? 1));
  $pages = max(1, (int)ceil($total / $per));
  $page = min($page, $pages);
  $offset = ($page-1)*$per;
  return [$page, $pages, $offset, $per];
}
function render_pagination($page, $pages, $baseUrl){
  if ($pages <= 1) return;
  echo "<div class='button-container'>";
  if ($page>1){ echo "<a class='btn' href='{$baseUrl}&page=".($page-1)."'>« Anterior</a>"; }
  echo "<span class='badge'>Página {$page} de {$pages}</span>";
  if ($page<$pages){ echo "<a class='btn' href='{$baseUrl}&page=".($page+1)."'>Siguiente »</a>"; }
  echo "</div>";
}

function options_from_table(PDO $pdo, $table, $col='nombre', $selected=null){
  $stmt = $pdo->query("SELECT {$col} as v FROM {$table} ORDER BY {$col} ASC");
  $html = "";
  foreach ($stmt as $r){
    $val = htmlspecialchars($r['v'], ENT_QUOTES, 'UTF-8');
    $sel = ($selected !== null && $selected === $r['v']) ? " selected" : "";
    $html .= "<option value='{$val}'{$sel}>{$val}</option>";
  }
  return $html;
}
