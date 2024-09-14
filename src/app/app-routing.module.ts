import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { UserComponent } from './components/user/user.component';
import { PostsComponent } from './components/post/post.component';
import { CommentsComponent } from './components/comments/comments.component';
import { CategoriesComponent } from './components/category/category.component';

const routes: Routes = [
  { path: 'users', component: UserComponent },
  { path: 'posts', component: PostsComponent },
  { path: 'comments', component: CommentsComponent },
  { path: 'categories', component: CategoriesComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
