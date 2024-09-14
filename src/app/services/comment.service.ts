import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Comment } from '../models/comment.model';

@Injectable({
  providedIn: 'root'
})
export class CommentService {
  private apiUrl = 'http://localhost:8000/posts'; // Adjusted API URL to handle nested comments

  constructor(private http: HttpClient) {}

  getComments(postId: number): Observable<Comment[]> {
    return this.http.get<Comment[]>(`${this.apiUrl}/${postId}/comments`, {
      headers: new HttpHeaders().set('Accept', 'application/json')
    });
  }

  createComment(postId: number, comment: Comment): Observable<Comment> {
    return this.http.post<Comment>(`${this.apiUrl}/${postId}/comments`, comment, {
      headers: new HttpHeaders().set('Accept', 'application/json')
    });
  }

  updateComment(postId: number, commentId: number, comment: Comment): Observable<Comment> {
    return this.http.put<Comment>(`${this.apiUrl}/${postId}/comments/${commentId}`, comment, {
      headers: new HttpHeaders().set('Accept', 'application/json')
    });
  }

  deleteComment(postId: number, commentId: number): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${postId}/comments/${commentId}`, {
      headers: new HttpHeaders().set('Accept', 'application/json')
    });
  }
}
