import { BaseResponse, BasePaginationResponse, BaseDetailResponse } from "@/shared/api/types";

export interface Image {
  uuid: string;
  mime_type: string;
  original_url: string;
  preview_url: string | null;
}

export interface Project {
  id: number;
  slug: string;
  title: string;
  description: string;
  price: number;
  time: string;
  image: Image;
  image_mobile: Image | null;
  video_cover: Image | null;
  link: string;
  is_big: boolean;
  is_case: boolean;
}

export interface ProjectDetail extends Project {
  content: unknown[];
}

export interface Award {
  id: number;
  title: string;
  description: string;
  award_image: Image;
  award_icon: Image;
  project: Project;
}

export type ProjectsResponse = BasePaginationResponse<Project>;

export type ProjectDetailResponse = BaseDetailResponse<
  { project: ProjectDetail },
  { awards: Award[] }
>;

export type ProjectDetailResponse2 = BaseResponse<{
  project: ProjectDetail;
  awards: Award[];
}>;
