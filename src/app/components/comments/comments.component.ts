import { Component, OnInit } from '@angular/core';
import { CommentService } from '../../services/comment.service';

@Component({
  selector: 'app-comments',
  templateUrl: './comments.component.html',
  styleUrls: ['./comments.component.css']
})
export class CommentsComponent implements OnInit {
  comments: any = [];
  postId: number = 1; // Set this to the actual post ID you want to work with

  constructor(private commentService: CommentService) {}

  ngOnInit(): void {
    this.getComments();
  }

  getComments(): void {
    this.commentService.getComments(this.postId).subscribe((data: any) => {
      this.comments = data;
    });
  }

  // Add methods for create, update, and delete operations as needed
}
