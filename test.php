
$item = new RenderPage($listItem);
$item->setContent('email', $user['email'])
    ->setContent('password', $user['password']);
$items .=  $item->render();