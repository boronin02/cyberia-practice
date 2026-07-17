import { fetchProjectById } from "@/entities/projects/api/projectsApi";
import { notFound } from "next/navigation";

interface ProjectPageProps {
  params: Promise<{
    id: string;
  }>;
}

export default async function ProjectPage({ params }: ProjectPageProps) {
  const { id } = await params;

  const project = await fetchProjectById(Number(id));

  if (!project) {
    notFound();
  }

  return (
    <section>
      <h1></h1>
    </section>
  );
}
