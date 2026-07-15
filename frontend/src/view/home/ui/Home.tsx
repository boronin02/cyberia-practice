import { Container } from "@/shared/ui/Container";
import { Awards, TrustUs } from "./components";
import { Hero } from "./components";
import { ProjectsList } from "@/widgets/Projects";
import { Banners } from "./components/Banners";

export const Home = () => {
  return (
    <>
      <Container>
        <Hero />
        <Awards />
        <ProjectsList showLoadButton={true} style="home" />
        <TrustUs />
        <Banners />
      </Container>
    </>
  );
};
